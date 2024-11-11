<?php

namespace App\Services\Verification;

use App\Facades\User\UserFacade;
use App\Models\ResetPasswordCode;
use App\Models\User;
use App\Models\VerificationCode;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

class VerificationService
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

    public function verifyCode(VerificationCode $code, int $inputCode): string|true
    {
        if(!$this->verifyExpired($code)){
            return 'Время действия кода истекло';
        }
        if(!$this->verifyNumbers($code, $inputCode)) {
            return 'Неверный код';
        }
        return true;
    }

    private function verifyExpired(VerificationCode $code): bool
    {
        if($code->expired_at < now()) {
            return false;
        }
        return true;
    }
    private function verifyNumbers(VerificationCode $code, int $inputCode):bool
    {
        if($code->code != $inputCode){
            return false;
        }
        return true;
    }

    public function getUserVerificationCode(array $data, $default = null)
    {
        $user = UserFacade::getUserByEmail($data['email']);
        $code = $user->codes->last();
        return $code instanceof VerificationCode ? $code : $default;
    }

}
