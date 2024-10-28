<?php

namespace App\Facades\VerificationCode;

use App\Services\VerificationCode\VerificationCodeService;
use Illuminate\Support\Facades\Facade;

class VerificationCodeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return VerificationCodeService::class;
    }
}
