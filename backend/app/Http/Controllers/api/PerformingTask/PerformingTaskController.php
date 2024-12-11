<?php

namespace App\Http\Controllers\api\PerformingTask;

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
        // $unsortedTasks = Auth::user()->perfo
    }

    public function store(StoreTaskUserRequest $request)
    {
        $data = PerformingTaskFacade::getData($request->input('task'));
        $row = PerformingTask::query()->create($data);
        return response()->json(['status' => 'success', ], 201);
    }

    public function update(Task $task, UpdateUserTasksRequest $request)
    {
        $data = PerformingTaskFacade::updateUserTasksData($task->id, $request->input('checkpoint'));
    }
}
