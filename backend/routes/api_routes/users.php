<?php

use App\Http\Controllers\api\User\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
->prefix('/accounts')
// ->middleware('auth:sanctum)
->group(function () {
    Route::get('/', 'index')->name('users.index');
    Route::patch('/me', 'update')->name('users.update');
});
