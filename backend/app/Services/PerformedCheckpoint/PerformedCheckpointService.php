<?php 

namespace App\Services\PerformedCheckpoint;

use App\Models\Checkpoint;
use App\Models\PerformedCheckpoint;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PerformedCheckpointService 
{
    public function getTaskCheckpoints(int $task): Collection
    {
        return PerformedCheckpoint::query()
        ->where('task_id', $task)
        ->where('user_id', Auth::user()->id)
        ->get();
    }

    public function initPerformedCheckpoints(int $task, int $user)
    {
        $checkpoints = Checkpoint::query()->where('task_id', $task)->get();
        foreach ($checkpoints as $checkpoint) {
            PerformedCheckpoint::query()->create([
                'task_id' => $task,
                'checkpoint_id' => $checkpoint->id,
                'user_id' => $user,
                'is_completed' => false
            ]);
        }
    }

    public function getPerformedCheckpoint(int $task, int $checkpoint): PerformedCheckpoint|null
    {
        return PerformedCheckpoint::query()
        ->where('checkpoint_id', $checkpoint)
        ->where('user_id', Auth::user()->id)->where('task_id', $task)->first();
    }
}