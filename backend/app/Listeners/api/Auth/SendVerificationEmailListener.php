<?php

namespace App\Listeners\api\Auth;

use App\Events\api\Auth\UserCreatedEvent;
use App\Facades\Email\EmailFacade;
use App\Facades\Verification\VerificationFacade;
use App\Facades\VerificationCode\VerificationCodeFacade;
use App\Jobs\api\Email\SendVerificationCodeJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationEmailListener 
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
    public function handle(UserCreatedEvent $event): void
    {
        SendVerificationCodeJob::dispatch($event->user)->onQueue('email');
    }
}
