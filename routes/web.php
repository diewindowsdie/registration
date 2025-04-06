<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\CompetitionsController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FormController::class, 'index'])->name('index');

Route::prefix('athletes')->name('athletes.')->group(function () {
    Route::post('save', [FormController::class, 'save'])->name('save');
});

Route::prefix('competitions')->name('competitions.')->group(function () {
    Route::get('/', [CompetitionsController::class, 'index'])->name('list');
    Route::get('new', [CompetitionsController::class, 'new'])->name('new');
    Route::post('create', [CompetitionsController::class, 'create'])->name('create');
    Route::get("registration/{id}", [RegistrationController::class, "registrationForm"])->name("registrationForm");
    Route::post("register", [RegistrationController::class, "register"])->name("register");
});

