<?php

use App\Http\Controllers\api\Mentor\MentorsController;
use Illuminate\Support\Facades\Route;

Route::controller(MentorsController::class)
->prefix('mentors')
->middleware('auth:sanctum')
->group(function () {
    Route::get('/', 'index')->name('mentors.index');
    Route::get('/{mentor}', 'show')->name('mentors.show');
    Route::patch('/{mentor}', 'update')->name('mentors.update');
    Route::delete('/{mentor}', 'delete')->name('mentors.delete');
});