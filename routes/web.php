<?php

use App\Http\Controllers\CompetitionsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\SecretaryOnlyAccess;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'index'])->name('index');

Route::prefix('athletes')->name('athletes.')->group(function () {
    Route::get("find", [RegistrationController::class, "findAthletes"])->name("find");
});

Route::prefix('competitions')->name('competitions.')->group(function () {
    Route::get('/', [CompetitionsController::class, 'index'])->name('list')->middleware(SecretaryOnlyAccess::class);;
    Route::get('new', [CompetitionsController::class, 'new'])->name('new')->middleware(SecretaryOnlyAccess::class);
    Route::post('create', [CompetitionsController::class, 'create'])->name('create')->middleware(SecretaryOnlyAccess::class);
    Route::get("registration/{id}", [RegistrationController::class, "registrationForm"])->name("registrationForm");
    Route::post("register", [RegistrationController::class, "register"])->name("register");
    Route::get("participants/{id}", [CompetitionsController::class, "getParticipants"])->name("participants");
});

