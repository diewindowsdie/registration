<?php

namespace App\Http\Controllers;

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
}
