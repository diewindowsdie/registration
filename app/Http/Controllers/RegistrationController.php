<?php

namespace App\Http\Controllers;

use App\Http\Requests\Athlete\SaveRequest;
use App\Models\ArcheryClass;
use App\Models\Athlete;
use App\Models\AthleteRegion;
use App\Models\Competition;
use App\Models\CompetitionGroup;
use App\Models\CompetitionParticipant;
use App\Models\Division;
use App\Models\SportQualification;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function index(): View
    {
        $competitions = Competition::all();
        return view('pages.competitions.list', ["competitions" => $competitions]);
    }

    public function registrationForm($id): View
    {
        $competition = Competition::find($id);
        if ($competition != null) {
            return view('pages.registration.registrationForm', [
                "competition" => $competition,
                "divisions" => Division::all(),
                "archery_classes" => ArcheryClass::all()
            ]);
        }

        return view("errors.404");
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
        $athlete->qualification_code = "M"; //todo поле ввода на форме
        $athlete->region_code = $request->input("region_code");

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

        if ($differenceCount >= 2) {
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
        $existingAthlete->save();

        return $existingAthlete;
    }

    private static function wrapUnsafeBoolean(array $array, string $key): int
    {
        if (!isset($array[$key])) {
            return 0;
        }

        return $array[$key] == true;
    }

    public function register(FormRequest $request): JsonResponse
    {
        //todo для каждой группы - если передан ключ "от пары спортсмен-соревнование"- ищем группу по спортсмену, соревнованию и дивизиону, и ставим то, что пришло с фронтенда, если участия нет - удаляем
        //todo если ключа нет - перед созданием проверяем существование группы, если она уже есть - пропускаем, если нет - создаем если включен флаг участия
        $athlete = $this->getRegisteringAthlete($request);
        foreach ($request->input("groups") as $group) {
            if ($group["participation"]) {
                $participant = new CompetitionParticipant();
                $participant->competition_id = $request->input("competition_id");
                $participant->athlete_id = $athlete->id;
                $participant->sport_school = $request->input("sport_school");
                $participant->sport_organisation = $request->input("sport_organisation");
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
            //'id' => $participant->id,
            //'participant' => $participant,
        ]);
    }
}
