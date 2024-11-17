<?php

namespace App\Jobs\api\Claim;

use App\Mail\api\Claim\CompleteClaim;
use App\Mail\api\Claim\RejectClaim;
use App\Models\Claim;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendClaimResponseJob implements ShouldQueue
{
    use Queueable;

    private User $user;
    private Claim $claim;
    
    public function __construct(
        array $data
    )
    {
        $this->user = $data['user'];
        $this->claim = $data['claim'];        
    }


    public function handle(): void
    {
        if($this->claim->claimStatus->code == 'reject')
        {
            Mail::to($this->user->email)->send(new RejectClaim($this->user, $this->claim));
        } else{
            Mail::to($this->user->email)->send(new CompleteClaim($this->user, $this->claim));
        }
    }
}
