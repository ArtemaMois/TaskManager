<?php

namespace App\Http\Controllers\api\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\Grade\StoreTaskGradeRequest;
use App\Models\Task;
use App\Models\TaskGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskGradeController extends Controller
{
    public function store(Task $task, StoreTaskGradeRequest $request)
    {
        $taskGrade = TaskGrade::query()->firstWhere(function ($q) use ($task) {
            return $q->where('user_id', '=', Auth::user()->id)->where('task_id', '=', $task->id);
        });
        if (is_null($taskGrade)) {
            $taskGrade = TaskGrade::create([
                'user_id' => Auth::user()->id,
                'stars' => $request->input('stars'),
                'task_id' => $task->id
            ]);
            return response()->json(['status' => 'success']);
        }
        return response(['status' => 'failed', 'error' => 'Вы уже поставили оценку']);
    }
}
