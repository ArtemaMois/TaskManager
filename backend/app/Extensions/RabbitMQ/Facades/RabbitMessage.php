<?php 

namespace App\Extensions\RabbitMQ\Facades;

use App\Extensions\RabbitMQ\Services\AMQPMessageService;
use Illuminate\Support\Facades\Facade;

class RabbitMessage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AMQPMessageService::class;
    }
}