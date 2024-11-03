<?php 

namespace App\Extensions\RabbitMQ\Facades;

use App\Extensions\RabbitMQ\Services\AMQPService;
use Illuminate\Support\Facades\Facade;

class RabbitMQ extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AMQPService::class;  
    }
}