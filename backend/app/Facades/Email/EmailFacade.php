<?php

namespace App\Facades\Email;

use App\Services\Email\EmailService;
use Illuminate\Support\Facades\Facade;

class EmailFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EmailService::class;
    }
}
