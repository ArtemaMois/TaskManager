<?php

use App\Http\Controllers\api\Chat\ChatsController;
use Illuminate\Support\Facades\Route;

Route::controller(ChatsController::class)
->middleware(['auth:sanctum'])
->prefix('/chats')
->group(function ()
{
    Route::post('/personal', 'personal')->name('chats.personal');
    Route::get('/self', 'myChats')->name('chats.self');
    Route::post('/test', 'test')->name('chats.test');
});