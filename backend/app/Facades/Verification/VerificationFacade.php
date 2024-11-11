<?php

namespace App\Facades\Verification;

use App\Services\Verification\VerificationService;
use Illuminate\Support\Facades\Facade;

class VerificationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return VerificationService::class;
    }
}
