<?php

namespace App\Http\Controllers;

use App\Http\Requests\Athlete\SaveRequest;
use App\Models\Athlete;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index(): View
    {
        return view('pages.registration');
    }

    public function load(Request $request): JsonResponse
    {
        $fixture = [];

        return response()->json($fixture);
    }

    public function save(SaveRequest $request): JsonResponse
    {
        $model = new Athlete();
        $model->first_name = $request->first_name;
        $model->surname = $request->surname;
        $model->patronymic = $request->patronymic;
        $model->gender = $request->gender;
        $model->birth_date = $request->birth_date;
        $model->region_code = $request->region_code;

        //$model->city = $request->city;
        //$model->phone = $request->phone;
        //$model->advertisement = (bool) $request->advertisement;

        $model->save();

        return response()->json([
            'status' => 'ok',
            'id' => $model->id,
            'model' => $model,
        ]);
    }
}
