<?php

use App\Http\Controllers\api\WS\WSController;
use Illuminate\Support\Facades\Route;

Route::controller(WSController::class)
->prefix('/ws')
->middleware(['auth:sanctum'])
->group(function ()
{
    Route::get('/token', 'connectionToken')->name('ws.token');
    Route::get('/channels', 'channels')->name('ws.channels');
    Route::post('/publish', 'publish')->name('ws.publish');
});