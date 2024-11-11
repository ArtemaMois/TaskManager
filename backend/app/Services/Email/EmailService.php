<?php

namespace App\Services\Email;

use App\Mail\api\Verification\Verification;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendVerificationEmail(User $user, VerificationCode $code)
    {
        return Mail::to($user)->send(new Verification($user, $code));
    }
}
