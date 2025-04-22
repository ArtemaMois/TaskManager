<?php

use App\Http\Controllers\api\User\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->prefix('/accounts')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', 'index')->name('users.index');
        Route::get('/me', 'me')->name('users.password.update');
        Route::get('/me/image', 'getUserImage')->name('users.image');
        Route::get('/admin/users', 'getUserForAdmin')->name('users.index.admin');
        Route::patch('/admin/users', 'updateUserRole')->name('users.update.role');
        Route::post('/me', 'update')->name('users.update');
        Route::patch('/me/password', 'changePassword')->name('users.password.update');
        Route::get("/cookie", "getCookie")->name('cookie');
        Route::get('/chat', 'userForChats')->name('users.chat');
});
