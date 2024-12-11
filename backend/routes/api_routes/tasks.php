<?php

use App\Http\Controllers\api\Task\TasksController;
use App\Http\Middleware\api\Auth\MentorMiddleware;
use Illuminate\Support\Facades\Route;

Route::controller(TasksController::class)
->prefix('tasks')
->group(function () {
   Route::get('/', 'index')->name('tasks.index');
   Route::post('/', 'store')->name('tasks.store')->middleware(MentorMiddleware::class);
   Route::patch('/{task}', 'update')->name('tasks.update')->middleware(MentorMiddleware::class);
   Route::delete('/{task}', 'delete')->name('tasks.delete')->middleware(MentorMiddleware::class); 
});