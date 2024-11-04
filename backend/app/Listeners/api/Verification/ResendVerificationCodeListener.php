<?php

namespace App\Listeners\api\Verification;

use App\Events\api\Verification\ResendCodeEvent;
use App\Extensions\RabbitMQ\Facades\RabbitMessage;
use App\Extensions\RabbitMQ\Facades\RabbitMQ;
use App\Jobs\api\Email\SendVerificationCodeJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ResendVerificationCodeListener
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
    public function handle(ResendCodeEvent $event): void
    {
        $message = RabbitMessage::makeMessage(SendVerificationCodeJob::class, $event->user);
        RabbitMQ::publish($message, 'laravel', 'verification');
    }
}
