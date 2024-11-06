<?php

use App\Http\Controllers\api\Timezone\TimezoneController;
use Illuminate\Support\Facades\Route;

Route::controller(TimezoneController::class)
->middleware('auth:sanctum')
->prefix('/timezones')
->group(function () {
    Route::get('/', 'index')->name('timezone.index');
});