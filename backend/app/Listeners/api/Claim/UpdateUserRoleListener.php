<?php

namespace App\Listeners\api\Claim;

use App\Events\api\Claim\CompleteClaimEvent;
use App\Models\Role;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserRoleListener
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
    }
}
