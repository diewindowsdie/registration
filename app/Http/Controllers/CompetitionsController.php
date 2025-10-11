<?php

namespace App\Http\Controllers;

use App\Auth\ClientCertificateOrBasicAuthAuthenticator;
use App\Composers\UpcomingCompetitionsComposer;
use App\Http\Requests\Athlete\SaveRequest;
use App\Models\ArcheryClass;
use App\Models\Competition;
use App\Models\CompetitionGroup;
use App\Models\CompetitionParticipant;
use App\Models\Division;
use App\Models\SportQualification;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class CompetitionsController extends Controller
{
    public function new(): View
    {
        return view('pages.competitions.new', [
            "divisions" => Division::orderBy("order", "asc")->get(),
            "archery_classes" => ArcheryClass::orderBy("order", "asc")->get(),
            "qualifications" => SportQualification::orderBy("order", "desc")->get()
        ]);
    }

    public function edit($idOrAlias): View
    {
        $competition = Competition::where("alias", "=", $idOrAlias)
            ->orWhere("id", "=", $idOrAlias)->first();
        if ($competition === null) {
            return view("errors.competitionNotFound");
        }

        return view('pages.competitions.edit', [
            "competition" => $competition,
            "divisions" => Division::orderBy("order", "asc")->get(),
            "archery_classes" => ArcheryClass::orderBy("order", "asc")->get(),
            "qualifications" => SportQualification::orderBy("order", "desc")->get()
        ]);
    }


    public function save(FormRequest $request): JsonResponse
    {
        $competition = Competition::findOrNew($request->input('id'));
        $competition->title = $request->input('title');
        $competition->alias = $request->input('alias');
        $competition->start_date = $request->input('start_date');
        $competition->end_date = $request->input('end_date');
        $competition->registration_start = $request->input('registration_start');
        $competition->registration_finish = $request->input('registration_finish');
        $competition->includes_mixed_team_events = self::wrapUnsafeBooleanFromRequest($request, 'includes_mixed_team_events');
        $competition->participants_list_available_to_anyone = self::wrapUnsafeBooleanFromRequest($request, 'participants_list_available_to_anyone');
        $competition->allow_countries = self::wrapUnsafeBooleanFromRequest($request, 'allow_countries');
        $competition->allow_input_school_and_club = self::wrapUnsafeBooleanFromRequest($request, 'allow_input_school_and_club');
        $competition->use_sport_qualification = self::wrapUnsafeBooleanFromRequest($request, 'use_sport_qualification');
        $competition->ui_language = $request->input('ui_language');
        if ($competition->created_by === null) {
            //не обновляем инфу о создавшем соревнование
            $competition->created_by = ClientCertificateOrBasicAuthAuthenticator::getAuthenticatedUserName();
        }

        $competition->save();
        if ($request->input('id') !== null) {
            //удалим существующие, которых нет в запросе
            $existingGroups = CompetitionGroup::where("competition_id", "=", $competition->id)->get();
            $receivedGroups = array_map(static function ($group) { return $group["id"]; }, $request->input("groups"));
            foreach ($existingGroups as $existingGroup) {
                if (!in_array($existingGroup->id, $receivedGroups)) {
                    CompetitionGroup::destroy($existingGroup->id);
                }
            }
        }
        foreach ($request->input("groups") as $group) {
            //обновляем существующие и создаем новые
            $competitionGroup = CompetitionGroup::findOrNew($group["id"]);
            $competitionGroup->competition_id = $competition->id;
            $competitionGroup->division_code = $group["division_code"];
            $competitionGroup->class_code = $group["class_code"];
            $competitionGroup->allowed_genders = $group["allowed_genders"];
            $competitionGroup->min_birth_date = $group["min_birth_date"];
            $competitionGroup->max_birth_date = $group["max_birth_date"];
            $competitionGroup->min_qualification_code = $group["min_qualification_code"];
            $competitionGroup->includes_teams = self::wrapUnsafeBoolean($group, "includes_teams");
            $competitionGroup->save();
        }

        return response()->json([
            'status' => 'ok',
            'competition_id' => $competition->id,
        ]);
    }

    public function deleteCompetition($id): JsonResponse
    {
        Competition::destroy($id);

        //Сразу не удаляем, какое-то время история поживет
        CompetitionParticipant::where("competition_id", "=", $id)->update(["competition_id" => "0"]);

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function loadUpcoming(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'competitions' => UpcomingCompetitionsComposer::loadUpcomingCompetitions()
        ]);
    }

    public function getParticipants($idOrAlias): object
    {
        $competition = Competition::where("alias", "=", $idOrAlias)
            ->orWhere("id", "=", $idOrAlias)->first();
        if ($competition === null) {
            return view("errors.competitionNotFound");
        }

        if (!$competition->participants_list_available_to_anyone &&
            !ClientCertificateOrBasicAuthAuthenticator::isAuthenticated()) {
            return response()->view("errors.forbidden")->setStatusCode(403);
        }

        App::setlocale($competition->ui_language);

        $participants = CompetitionParticipant::where("competition_id", "=", $competition->id)->get();
        if (!ClientCertificateOrBasicAuthAuthenticator::isAuthenticated()) {
            $participants = $participants->makeHidden(["contact_information", "coach_name"]);
        }

        return view('pages.competitions.participants', [
            "competition" => $competition,
            "participants" => $participants
        ]);
    }

    public function deleteParticipant($id): JsonResponse
    {
        CompetitionParticipant::destroy($id);

        return response()->json([
            'status' => 'ok'
        ]);
    }
}
