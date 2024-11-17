<?php

namespace App\Listeners\api\Mentor;

use App\Events\api\Claim\CompleteClaimEvent;
use App\Facades\Mentor\MentorFacade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateMentorListener
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
        $mentor = MentorFacade::createMentor($event->user, $event->category);
    }
}
