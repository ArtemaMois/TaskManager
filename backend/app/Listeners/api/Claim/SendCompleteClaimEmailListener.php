<?php

namespace App\Listeners\api\Claim;

use App\Events\api\Claim\CompleteClaimEvent;
use App\Extensions\RabbitMQ\Facades\RabbitMessage;
use App\Extensions\RabbitMQ\Facades\RabbitMQ;
use App\Jobs\api\Claim\SendClaimResponseJob;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCompleteClaimEmailListener implements ShouldDispatchAfterCommit
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
    public function handle(CompleteClaimEvent $event): void
    {
        $message = RabbitMessage::makeMessage(SendClaimResponseJob::class, ['user' => $event->user, 'claim' => $event->claim]);
        RabbitMQ::publish($message, 'laravel', 'verification');
    }
}
