<?php

use App\Http\Controllers\api\Settings\SettingsController;
use Illuminate\Support\Facades\Route;

Route::controller(SettingsController::class)
->prefix('account/settings')
->middleware('auth:sanctum')
->group(function ()
{
    Route::get('/', 'index')->name('settings.index');
    Route::patch('/', 'update')->name('settings.update');
});