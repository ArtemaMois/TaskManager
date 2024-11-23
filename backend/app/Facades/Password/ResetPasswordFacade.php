<?php 

namespace App\Facades\Password;

use App\Services\Password\ResetPasswordService;
use Illuminate\Support\Facades\Facade;

class ResetPasswordFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ResetPasswordService::class;
    }
}