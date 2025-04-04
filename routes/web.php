<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FormController::class, 'index'])->name('index');

Route::prefix('athletes')->name('athletes.')->group(function () {
    Route::post('save', [FormController::class, 'save'])->name('save');
});
