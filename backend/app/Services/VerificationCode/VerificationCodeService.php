<?php

namespace App\Services\VerificationCode;

use App\Models\User;
use App\Models\VerificationCode;

class VerificationCodeService
{
    public function getVerificationCode(User $user): VerificationCode
    {
        $code = $this->createCode();
        $verificationCode = VerificationCode::query()->create([
            'code' => $code,
            'user_id' => $user->id,
            'expired_at' => now()->addMinutes(10)
        ]);
        return $verificationCode;
    }

    private function createCode(): int
    {
        $code = mt_rand(0, 999999);
        str_pad($code, 6, "0", STR_PAD_LEFT);
        return $code;
    }
}
