<?php

namespace App\Services\PerformingTask;

use App\Models\Checkpoint;
use App\Models\PerformedCheckpoint;
use Illuminate\Support\Facades\Auth;

class PerformingTaskService
{
    public function getData(int $task_id)
    {
        $user_id = Auth::user()->id;
        $this->createCompleteCheckpoints($task_id, $user_id);
        return [
            'task_id' => $task_id,
            'user_id' => $user_id,
            'progress' => 0,
            'is_completed' => false
        ];
    }

    private function createCompleteCheckpoints(int $task_id, int $user_id)
    {
        $checkpoint_ids = Checkpoint::query()->where('task_id', $task_id)->get('id');
        foreach ($checkpoint_ids as $id) {
            PerformedCheckpoint::query()->create([
                'task_id' => $task_id,
                'checkpoint_id' => $id,
                'user_id' => $user_id,
                'is_completed' => false
            ]);
        }
    }

    private function updateProgress() {}

}
