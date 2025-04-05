<?php

namespace App\Listeners\api\Mentor;

use App\Events\api\Claim\CompleteClaimEvent;
use App\Facades\Mentor\MentorFacade;
use App\Models\Role;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class CreateMentorListener implements ShouldDispatchAfterCommit
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
        $event->user->update([
            'role_id' => Role::query()->where('code', 'mentor')->first()->id
        ]);
        $mentor = MentorFacade::createMentor($event->user, $event->category);
    }
}
