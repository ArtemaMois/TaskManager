<?php

namespace App\Jobs\api\Email;

use App\Facades\Email\EmailFacade;
use App\Facades\Verification\VerificationFacade;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendVerificationCodeJob implements ShouldQueue
{
    use Queueable;


    public function __construct(
        private User $user
    )
    {
        
    }

    public function handle(): void
    {
        $code = VerificationFacade::getVerificationCode($this->user);
        EmailFacade::sendVerificationEmail($this->user, $code);
    }
}
