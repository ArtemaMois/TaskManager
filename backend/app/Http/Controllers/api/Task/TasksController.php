<?php

namespace App\Http\Controllers\api\Task;

use App\Events\api\Task\TaskCreatedEvent;
use App\Facades\Task\TaskFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Task\StoreTaskRequest;
use App\Http\Resources\api\Checkpoint\MinifiedCheckpointResource;
use App\Http\Resources\api\Task\TaskResource;
use App\Models\Task;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller implements ShouldDispatchAfterCommit
{
    public function index()
    {
        $tasks = TaskResource::collection(Task::all());
        return response()->json(['status' => 'success', 'tasks' => $tasks]);
    }

    public function store(StoreTaskRequest $request)
    {
        // $task = DB::transaction(function () use ($request){
        //     $data = TaskFacade::getFormedData($request->validated());
        //     $task = Task::query()->create($data);
        //     return $task;
        // });
        $data = TaskFacade::getFormedData($request->validated());
        $task = Task::query()->create($data);
        TaskFacade::initTaskCheckpoints($task, $request['checkpoints']);
        return response()->json(['status' => 'success', 'task' => new TaskResource($task)], 201);
    }

    public function show(int $task)
    {
        $task = Task::find($task);
        return response()->json(['status' => 'success', 'task' =>  new TaskResource($task)]);
    }
 
    public function delete(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }
}
