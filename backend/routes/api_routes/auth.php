<?php

use App\Http\Controllers\api\Auth\AuthController;
use App\Http\Controllers\api\User\UserController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
->prefix('/auth')
->group(function () {
    Route::post('/register', 'register')->name('auth.register');
    Route::post('/login', 'login')->name('auth.login');
    Route::post('/reset-password', 'resetPassword')->name('auth.reset-password');
    Route::post('/reset-password/check', 'checkResetCode')->name('auth.reset-password.check');
});


