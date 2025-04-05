<?php 

namespace App\Facades\Chat;

use App\Services\Chat\ChatService;
use Illuminate\Support\Facades\Facade;

class ChatFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ChatService::class;
    }
}