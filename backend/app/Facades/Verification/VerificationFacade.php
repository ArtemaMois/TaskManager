<?php

namespace App\Facades\Verification;

use App\Services\VerificationCode\VerificationCodeService;
use Illuminate\Support\Facades\Facade;

class VerificationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return VerificationCodeService::class;
    }
}
