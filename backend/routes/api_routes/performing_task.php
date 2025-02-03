<?php

use App\Http\Controllers\api\PerformingTask\PerformingTaskController;
use App\Http\Middleware\api\PerformingTask\UnStartedTaskMiddleware;
use Illuminate\Support\Facades\Route;

Route::controller(PerformingTaskController::class)
->prefix('/user/tasks')
->middleware('auth:sanctum')
->group(function () {
    Route::get('/', 'index')->name('performing_task.index');
    Route::post('/', 'store')->name('performing_task.post')->middleware(UnStartedTaskMiddleware::class);
    Route::patch('/{task}', 'update')->name('performing_tasks.update');
});