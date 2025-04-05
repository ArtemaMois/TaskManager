<?php

use App\Http\Controllers\api\ClaimStatus\ClaimStatusController;
use Illuminate\Support\Facades\Route;

Route::controller(ClaimStatusController::class)
->prefix('/claim-statuses')
->middleware('auth:sanctum')
->group(function () {
    Route::get('/', 'index')->name('claim_status.index');
    Route::post('/', 'store')->name('claim_status.store');
    Route::delete('/{status}', 'delete')->name('claim_status.delete');
});