<?php

namespace App\Listeners\api\Task;

use App\Events\api\Task\TaskCompletedEvent;
use App\Extensions\RabbitMQ\Facades\RabbitMessage;
use App\Extensions\RabbitMQ\Facades\RabbitMQ;
use App\Jobs\api\Email\SendVerificationCodeJob;
use App\Jobs\api\Task\SendTaskCompletedNotificationJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTaskCompletedNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskCompletedEvent $event): void
    {
        $message = RabbitMessage::makeMessage(SendTaskCompletedNotificationJob::class, 
        ['user' => $event->user, 'task_title' => $event->task_title]);
        RabbitMQ::publish($message, 'laravel', 'verification');
    }
}
