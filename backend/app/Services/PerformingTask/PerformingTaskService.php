<?php

namespace App\Services\PerformingTask;

use App\Events\api\Task\TaskCompletedEvent;
use App\Facades\PerformedCheckpoint\PerformedCheckpointFacade;
use App\Mail\api\Task\TaskCompleted;
use App\Models\Checkpoint;
use App\Models\PerformedCheckpoint;
use App\Models\PerformingTask;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\progress;

class PerformingTaskService
{

    public function sortTaskByCompletion(Collection $tasks)
    {
        $completedTasks = [];
        $uncompletedTasks = [];
        foreach ($tasks as $task) {
            if($task->is_completed)
            {
                $completedTasks[] = $task;
            } else {
                $uncompletedTasks[] = $task;
            }
        }
        return [
            'completed' => $completedTasks,
            'uncompleted' => $uncompletedTasks
        ];
    }
    public function getData(int $task_id)
    {
        $user_id = Auth::user()->id;
        PerformedCheckpointFacade::initPerformedCheckpoints($task_id, $user_id);
        return [
            'task_id' => $task_id,
            'user_id' => $user_id,
            'progress' => 0,
            'is_completed' => false
        ];
    }

    public function updateProgress(Task $task): int 
    {
        $progress = $this->getProgress($task->id);
        if($progress == 100)
        {
            event(new TaskCompletedEvent(Auth::user(), $task->title));
            $this->completeTask($task->id, $progress, true);
        } else{
            $this->completeTask($task->id, $progress);
        }
        return $progress;
    }

    private function completeTask(int $task, int $progress, bool $is_completed = false)
    {
        $data = $is_completed ? 
        [
            'progress' => $progress,
            'is_completed' => $is_completed
        ] :
        [
            'progress' => $progress
        ];
        return PerformingTask::query()
        ->where('task_id', $task)
        ->where('user_id', Auth::user()->id)
        ->first()
        ->updateOrFail($data);
    }
    private function getProgress(int $task_id): int
    {
        $allCheckpoints = PerformedCheckpointFacade::getTaskCheckpoints($task_id);
        $allCheckpointsCount = 0;
        $completedCheckpoint = 0;
        foreach($allCheckpoints as $checkpoint)
        {
            if($checkpoint->is_completed){
                $completedCheckpoint+=1;
            }
            $allCheckpointsCount+=1;
        }
        return intval(($completedCheckpoint/$allCheckpointsCount)*100);
        
    }
}
