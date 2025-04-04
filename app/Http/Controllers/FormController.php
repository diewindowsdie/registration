<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class FormController extends Controller
{
    public function index(): View
    {
        return view('pages.registration');
    }
}
