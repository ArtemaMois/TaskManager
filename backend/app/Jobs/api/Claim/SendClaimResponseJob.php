<?php

namespace App\Jobs\api\Claim;

use App\Models\Claim;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendClaimResponseJob implements ShouldQueue
{
    use Queueable;


    public function __construct(
        private User $user,
        private Claim $claim
    )
    {
        
    }


    public function handle(): void
    {
        //
    }
}
