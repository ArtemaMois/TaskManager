<?php

use App\Http\Controllers\api\Grade\TaskGradeController;
use Illuminate\Support\Facades\Route;

Route::controller(TaskGradeController::class)
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('/tasks/{task}/grades', 'store')->name('task.grade.store');
    });
