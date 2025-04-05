<?php

namespace App\Http\Controllers;

use App\Http\Requests\Athlete\SaveRequest;
use App\Models\Athlete;
use App\Models\Competition;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompetitionsController extends Controller
{
    public function index(): View
    {
        $competitions = Competition::all();
        return view('pages.competitions.list', ["competitions" => $competitions]);
    }

    public function load(Request $request): JsonResponse
    {
        $fixture = [];

        return response()->json($fixture);
    }

    public function new(): View
    {
        return view('pages.competitions.new');
    }

    public function create(FormRequest $request): JsonResponse
    {
        $model = new Competition();
        $model->title = $request->title;
        $model->start_date = $request->start_date;
        $model->end_date = $request->end_date;
        $model->registration_start = $request->registration_start;
        $model->registration_finish = $request->registration_finish;
        $model->competition_includes_teams = $request->competition_includes_teams;
        $model->competition_includes_mixed_teams = $request->competition_includes_mixed_teams;
        $model->participants_list_available_to_anyone = $request->participants_list_available_to_anyone;
        $model->created_by = "test"; //todo fixme later

        $model->save();

        return response()->json([
            'status' => 'ok',
            'id' => $model->id,
            'model' => $model,
        ]);
    }
}
