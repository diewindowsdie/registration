<?php

namespace App\Http\Controllers;

use App\Http\Requests\Athlete\SaveRequest;
use App\Models\Athlete;
use App\Models\AthleteRegion;
use App\Models\Competition;
use App\Models\CompetitionGroup;
use App\Models\CompetitionParticipant;
use App\Models\SportOrganisation;
use App\Models\SportQualification;
use App\Models\SportSchool;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

enum RegistrationError implements \JsonSerializable
{
    case ALREADY_EXISTS;
    case INVALID_GENDER_FOR_GROUP;
    case INVALID_BIRTH_DATE_FOR_GROUP;
    case DIFFERENT_CLASSES_IN_SAME_COMPETITION;

    public function jsonSerialize(): string
    {
        return $this->name;
    }
}

class RegistrationController extends Controller
{
    public function index(): View
    {
        return view('pages.registration');
    }

    public function registrationForm($id): View
    {
        $competition = Competition::find($id);
        if ($competition === null) {
            return view("errors.competitionNotFound");
        }

        if ($competition->ui_language !== "RU") {
            App::setlocale("EN");
        }

        if ($competition->registration_start->isAfter(Carbon::now()) ||
            $competition->registration_finish->isBefore(Carbon::now())) {
            return view("errors.registrationIsNotOpen", [
                "competition" => $competition
            ]);
        }

        return view('pages.registration.registrationForm', [
            "competition" => $competition,
            "qualifications" => SportQualification::orderBy("order", "desc")->get(),
            "regions" => AthleteRegion::orderBy("full_name", "asc")->get(),
            "sport_schools" => SportSchool::orderBy("full_title", "asc")->get(),
            "sport_organisations" => SportOrganisation::orderBy("full_title", "asc")->get()
        ]);
    }

    public function findAthletes(Request $request): JsonResponse
    {
        //выберем спортсменов, у которых еще нет ни одной записи о регистрации на эти соревнования
        $athletes = Athlete::fromQuery("select a.* from athletes a
left join (select count(1) as cnt, athlete_id from competition_participants where competition_id = :competition_id group by athlete_id) s
                                               on s.athlete_id = a.id
where a.surname like :surname and coalesce(s.cnt, 0) = 0 limit 3", [":surname" => $request->get("surname") . "%", ":competition_id" => $request->get("competition_id")]);
        $athletes->load(["region", "qualification"]);

        return response()->json([
            'status' => 'ok',
            'athletes' => $athletes
        ]);
    }

    private function createNewAthlete(Athlete $athlete): Athlete
    {
        $existingAthlete = Athlete::where([
            ["surname", "=", $athlete->surname],
            ["first_name", "=", $athlete->first_name],
            ["patronymic", "=", $athlete->patronymic],
            ["gender", "=", $athlete->gender],
            ["birth_date", "=", $athlete->birth_date]
        ])->first();
        if ($existingAthlete !== null) {
            return $existingAthlete;
        }

        $athlete->save();
        return $athlete;
    }

    private function getRegisteringAthlete(FormRequest $request): Athlete
    {
        $athlete = new Athlete();
        $athlete->surname = $request->input("surname");
        $athlete->first_name = $request->input("first_name");
        $athlete->patronymic = $request->input("patronymic");
        $athlete->birth_date = $request->input("birth_date");

        $athlete->gender = $request->input("gender");
        $athlete->qualification_code = $request->input("qualification");
        $athlete->region_code = $request->input("region_code");
        $athlete->using_chair = $request->input("using_chair") ? 1 : 0;

        if ($request->input("athlete_id") === null) {
            return $this->createNewAthlete($athlete);
        }

        $existingAthlete = Athlete::find($request->input("athlete_id"));
        if ($existingAthlete === null) {
            return $this->createNewAthlete($athlete);
        }

        //сравним по полям существующего и присланного, если обнаружено два и более различия - создаем нового
        $differenceCount = 0;

        if ($athlete->surname !== $existingAthlete->surname) {
            $differenceCount++;
        }
        if ($athlete->first_name !== $existingAthlete->first_name) {
            $differenceCount++;
        }
        if ($athlete->gender !== $existingAthlete->gender) {
            $differenceCount++;
        }
        if (!$existingAthlete->birth_date->eq($athlete->birth_date)) {
            $differenceCount++;
        }
        if ($athlete->qualification_code !== $existingAthlete->qualification_code) {
            $differenceCount++;
        }
        if ($athlete->region_code !== $existingAthlete->region_code) {
            $differenceCount++;
        }
        if ($athlete->using_chair !== $existingAthlete->using_chair) {
            $differenceCount++;
        }

        if ($differenceCount >= 3) {
            return $this->createNewAthlete($athlete);
        }

        //изменений не так много, чтобы нужно было создавать нового, обновим и сохраним существующего
        $existingAthlete->surname = $athlete->surname;
        $existingAthlete->first_name = $athlete->first_name;
        $existingAthlete->patronymic = $athlete->patronymic;
        $existingAthlete->birth_date = $athlete->birth_date;
        $existingAthlete->gender = $athlete->gender;
        $existingAthlete->qualification_code = $athlete->qualification_code;
        $existingAthlete->region_code = $athlete->region_code;
        $existingAthlete->using_chair = $athlete->using_chair;
        $existingAthlete->save();

        return $existingAthlete;
    }

    private static function checkRegistrationBusinessLogicErrors($request, $athlete): array
    {
        //сначала проверим, есть ли регистрация хотя бы в один дивизион у спортсмена, если есть - возвращаем ошибку
        $existingRegistration = CompetitionParticipant::where([
            ["athlete_id", "=", $athlete->id],
            ["competition_id", "=", $request->input("competition_id")]
        ])->count();
        if ($existingRegistration > 0) {
            return [RegistrationError::ALREADY_EXISTS];
        }

        //проверим, что во всех группах пол спортсмена соответствует разрешенным в группе и возраст спортсмена соответствует требованиям группы
        //проверим, что во всех группах, куда спортсмен заявился, одинаковый класс
        $foundClass = "";
        foreach ($request->input("groups") as $group) {
            if ($group["participation"]) {
                $existingGroup = CompetitionGroup::findOrFail($group["id"]);

                if ($foundClass === "") {
                    $foundClass = $existingGroup->class_code;
                }
                if ($foundClass !== $existingGroup->class_code) {
                    return [RegistrationError::DIFFERENT_CLASSES_IN_SAME_COMPETITION];
                }

                if (!in_array($athlete->gender, $existingGroup->allowed_genders, true)) {
                    return [RegistrationError::INVALID_GENDER_FOR_GROUP];
                }
                if (($existingGroup->min_birth_date !== null && $athlete->birth_date->lt($existingGroup->min_birth_date)) ||
                    $athlete->birth_date->gt($existingGroup->max_birth_date)) {
                    return [RegistrationError::INVALID_BIRTH_DATE_FOR_GROUP];
                }
            }
        }

        return [];
    }

    public function register(FormRequest $request): object
    {
        $competition = Competition::find($request->input("competition_id"));
        if ($competition === null) {
            return response()->view("errors.competitionNotFound")->setStatusCode(404);
        }
        if ($competition->registration_start->isAfter(Carbon::now()) ||
            $competition->registration_finish->isBefore(Carbon::now())) {
            return response()->view("errors.registrationIsNotOpen", [
                "competition" => $competition
            ])->setStatusCode(422);
        }

        $athlete = $this->getRegisteringAthlete($request);
        $errors = self::checkRegistrationBusinessLogicErrors($request, $athlete);
        if (count($errors) > 0) {
            Log::warning("Ошибки при регистрации спортсмена на соревнования: competition_id = {competition_id}, athlete_id = {athlete_id}, errors = {errors}",
                ["competition_id" => $request->input("competition_id"), "athlete_id" => $request->input("athlete_id"), "errors" => $errors]);
            return response()->json([
                'status' => 'error',
                'errors' => $errors
            ], 422);
        }

        foreach ($request->input("groups") as $group) {
            if ($group["participation"]) {
                $participant = new CompetitionParticipant();
                $participant->competition_id = $request->input("competition_id");
                $participant->athlete_id = $athlete->id;
                $participant->sport_school_code = $request->input("sport_school_code");
                $participant->sport_organisation_code = $request->input("sport_organisation_code");
                $participant->contact_information = $request->input("contact_information");
                $participant->coach_name = $request->input("coach_name");

                $existingGroup = CompetitionGroup::findOrFail($group["id"]);
                $participant->division_code = $existingGroup->division_code;
                $participant->class_code = $existingGroup->class_code;
                $participant->participate_teams = self::wrapUnsafeBoolean($group, "participate_teams");
                $participant->participate_mixed_teams = self::wrapUnsafeBoolean($group, "participate_mixed_teams");

                $participant->save();
            }
        }

        return response()->json([
            'status' => 'ok',
        ]);
    }
}
