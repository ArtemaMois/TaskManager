<?php 

namespace App\Services\Password;

use App\Facades\User\UserFacade;
use App\Models\ResetPasswordCode;
use App\Models\User;

class ResetPasswordService
{
    public function getResetPasswordCode(User $user)
    {
        $code = $this->createCode();
        $resetCode = ResetPasswordCode::query()->create([
            'code' => $code,
            'user_id' => $user->id,
            'expired_at' => now()->addMinutes(10)
        ]);
        return $resetCode;
    }

    public function createCode(): int
    {
        $code = mt_rand(0, 999999);
        str_pad($code, 6, "0", STR_PAD_LEFT);
        return $code;
    }

    
    private function checkExpired(ResetPasswordCode $code): bool
    {
        if($code->expired_at < now()) {
            return false;
        }
        return true;
    }
    private function checkNumbers(ResetPasswordCode $code, int $inputCode):bool
    {
        if($code->code != $inputCode){
            return false;
        }
        return true;
    }

    public function checkResetCode(ResetPasswordCode $code, int $inputCode)
    {
        $errors = [];
        if(!$this->checkExpired($code)){
            $errors[] = 'Время действия кода истекло';
        }
        if(!$this->checkNumbers($code, $inputCode)) {
            $errors[] = 'Неверный код';
        }
        return isset($errors) ? $errors : null;
    }

    public function getLastUserResetCode(string $email, $default = null)
    {
        $user = UserFacade::getUserByEmail($email);
        $code = $user->resetCodes->last();
        return $code instanceof ResetPasswordCode ? $code : $default;
    }
}