<?php

namespace App\Jobs\api\Verification;

use App\Facades\Email\EmailFacade;
use App\Facades\Verification\VerificationFacade;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ResendVerificationCode implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private User $user
    )
    {
        //
    }
    public function handle(): void
    {
        dump(1);
        $code = VerificationFacade::getVerificationCode($this->user);
        EmailFacade::sendVerificationEmail($this->user, $code);
    }
}
