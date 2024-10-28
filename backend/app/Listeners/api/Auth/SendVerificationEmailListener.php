<?php

namespace App\Listeners\api\Auth;

use App\Events\api\Auth\UserCreatedEvent;
use App\Facades\Email\EmailFacade;
use App\Facades\Verification\VerificationFacade;
use App\Facades\VerificationCode\VerificationCodeFacade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendVerificationEmailListener implements ShouldQueue
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
        $code = VerificationFacade::getVerificationCode($event->user);
        EmailFacade::sendVerificationEmail($event->user, $code);
    }
}
