<?php

namespace App\Listeners\api\Checkpoint;

use App\Events\api\Task\TaskCreatedEvent;
use App\Models\Checkpoint;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateCheckpointsListener 
{

    public function __construct()
    {
        //
    }

    public function handle(TaskCreatedEvent $event): void
    {
        dd($event->checkpoints);
        foreach ($event->checkpoints as $key => $value) {
            Checkpoint::query()->create(
                [
                    'task_id' => $event->task->id,
                    'title' => $value,
                    'order' => $key
                ]
            );
        }
    }
}
