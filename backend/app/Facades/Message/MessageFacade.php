<?php 

namespace App\Facades\Message;

use App\Services\Message\MessageService;
use Illuminate\Support\Facades\Facade;

class MessageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MessageService::class;
    }
}