<?php

namespace App\Jobs\api\Password;

use App\Facades\Password\ResetPasswordFacade;
use App\Facades\Verification\VerificationFacade;
use App\Mail\api\Password\ResetPassword;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendResetPasswordCodeJob implements ShouldQueue
{
    use Queueable;


    public function __construct(
        private User $user
    )
    {
        
    }


    public function handle(): void
    {
        $code = ResetPasswordFacade::getResetPasswordCode($this->user);
        Mail::to($this->user->email)->send(new ResetPassword($this->user, $code));
    }
}
