<?php

use App\Http\Controllers\api\Claim\ClaimsController;
use App\Http\Middleware\api\AdminMiddleware;
use App\Http\Middleware\api\NotUpdatedClaims;
use Illuminate\Support\Facades\Route;

Route::controller(ClaimsController::class)
->prefix('/claims')
->middleware('auth:sanctum')
->group(function () {
    Route::get('/', 'index')->name('claim.index')->middleware(AdminMiddleware::class);
    Route::post('/', 'store')->name('claim.store');
    Route::patch('/{claim}', 'update')->name('claim.update')->middleware([NotUpdatedClaims::class, AdminMiddleware::class]);
});