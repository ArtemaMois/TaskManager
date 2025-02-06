<?php

namespace App\Http\Controllers\api\PerformingTask;

use App\Facades\PerformedCheckpoint\PerformedCheckpointFacade;
use App\Facades\PerformingTask\PerformingTaskFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\TaskUser\StoreTaskUserRequest;
use App\Http\Requests\api\TaskUser\UpdateUserTasksRequest;
use App\Models\Checkpoint;
use App\Models\PerformedCheckpoint;
use App\Models\PerformingTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerformingTaskController extends Controller
{
    public function index()
    {
        $tasks = PerformingTask::query()
        ->where('user_id', Auth::user()
        ->id)->get();
        $result = PerformingTaskFacade::sortTaskByCompletion($tasks);
        return response()->json(['status' => 'success', 'completed' => $result['completed'], 'handling' => $result['uncompleted']]);        
    }

    public function store(StoreTaskUserRequest $request)
    {
        $data = PerformingTaskFacade::getData($request->input('task'));
        $row = PerformingTask::query()->create($data);
        return response()->json(['status' => 'success', ], 201);
    }

    public function update(Task $task, UpdateUserTasksRequest $request)
    {
        $updatedCheckpoint = PerformedCheckpointFacade::getPerformedCheckpoint($task->id, $request->input('checkpoint'));
        if(is_null($updatedCheckpoint)){
            return response()->json(['status' => 'failed', 'message' => 'Неверные данные для обновления прогресса'], 400);
        }
        $updatedCheckpoint->update(['is_completed' => true]);
        $progress = PerformingTaskFacade::updateProgress($task);
        return response()->json(['status' => 'success', 'progress' => $progress]);
    }
}
