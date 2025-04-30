<?php

namespace App\Http\Controllers;

use App\Auth\ClientCertificateOrBasicAuthAuthenticator;
use App\Http\Requests\Athlete\SaveRequest;
use App\Models\ArcheryClass;
use App\Models\Competition;
use App\Models\CompetitionGroup;
use App\Models\CompetitionParticipant;
use App\Models\Division;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class CompetitionsController extends Controller
{
    public function index(): View
    {
        $competitions = Competition::all();
        return view('pages.competitions.list', ["competitions" => $competitions]);
    }

    public function new(): View
    {
        return view('pages.competitions.new', [
            "divisions" => Division::orderBy("order", "asc")->get(),
            "archery_classes" => ArcheryClass::orderBy("order", "asc")->get()
        ]);
    }

    public function create(FormRequest $request): JsonResponse
    {
        $competition = new Competition();
        $competition->title = $request->input('title');
        $competition->start_date = $request->input('start_date');
        $competition->end_date = $request->input('end_date');
        $competition->registration_start = $request->input('registration_start');
        $competition->registration_finish = $request->input('registration_finish');
        $competition->includes_mixed_team_events = self::wrapUnsafeBooleanFromRequest($request, 'includes_mixed_team_events');
        $competition->participants_list_available_to_anyone = self::wrapUnsafeBooleanFromRequest($request, 'participants_list_available_to_anyone');
        $competition->created_by = ClientCertificateOrBasicAuthAuthenticator::getAuthenticatedUserName();

        $competition->save();
        foreach ($request->input("groups") as $group) {
            $competitionGroup = new CompetitionGroup();
            $competitionGroup->competition_id = $competition->id;
            $competitionGroup->division_code = $group["division_code"];
            $competitionGroup->class_code = $group["class_code"];
            $competitionGroup->allowed_genders = $group["allowed_genders"];
            $competitionGroup->min_birth_date = $group["min_birth_date"];
            $competitionGroup->max_birth_date = $group["max_birth_date"];
            $competitionGroup->includes_teams = self::wrapUnsafeBoolean($group, "includes_teams");
            $competitionGroup->save();
        }

        return response()->json([
            'status' => 'ok',
            'competition_id' => $competition->id,
        ]);
    }

    public function getParticipants($id): object
    {
        $competition = Competition::find($id);
        if (!$competition->participants_list_available_to_anyone &&
            !ClientCertificateOrBasicAuthAuthenticator::isAuthenticated()) {
            return response()->view("errors.forbidden")->setStatusCode(403);
        }

        $participants = CompetitionParticipant::where("competition_id", "=", $id)
            ->get();
        if (!ClientCertificateOrBasicAuthAuthenticator::isAuthenticated()) {
            $participants = $participants->makeHidden(["contact_information", "coach_name"]);
        }

        return view('pages.competitions.participants', [
            "competition" => $competition,
            "participants" => $participants
        ]);
    }
}
