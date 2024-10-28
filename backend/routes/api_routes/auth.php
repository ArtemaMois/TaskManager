<?php

use App\Http\Controllers\api\Auth\AuthController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
->prefix('/auth')
->group(function () {
    Route::post('/register', 'register')->name('auth.register');
    Route::post('/login', 'login')->name('auth.login');
});

Route::get('/test', [TestController::class, 'test'])->middleware('auth:sanctum',);
