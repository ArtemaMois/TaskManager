<?php

namespace App\Jobs\api\Task;

use App\Mail\api\Task\TaskCompleted;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendTaskCompletedNotificationJob implements ShouldQueue
{
    use Queueable;

    private User $user;
    private string $task_title;
    public function __construct(
        array $data
    )
    {
        $this->user = $data['user'];
        $this->task_title = $data['task_title'];
    }

    public function handle(): void
    {
        Mail::to($this->user->email)->send(new TaskCompleted($this->user->login, $this->task_title));       
    }
}
