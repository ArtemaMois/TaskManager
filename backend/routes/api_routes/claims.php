<?php

use App\Http\Controllers\api\Claim\ClaimsController;
use Illuminate\Support\Facades\Route;

Route::controller(ClaimsController::class)
->prefix('/claims')
->middleware('auth:sanctum')
->group(function () {
    Route::get('/', 'index')->name('claim.index');
    Route::post('/', 'store')->name('claim.store');
    Route::patch('/', 'update')->name('claim.update');
});