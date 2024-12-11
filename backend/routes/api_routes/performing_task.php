<?php

use App\Http\Controllers\api\PerformingTask\PerformingTaskController;
use Illuminate\Support\Facades\Route;

Route::controller(PerformingTaskController::class)
->prefix('/user/tasks')
->group(function () {
    Route::get('/', 'index')->name('performing_task.index');
    Route::post('/user/tasks/', 'store')->name('performing_task.post');
    Route::patch('/user/tasks/{task_id}', 'update')->name('performing_tasks.update');
});