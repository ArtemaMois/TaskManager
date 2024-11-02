<?php 

namespace App\Extensions\RabbitMQ\Facades;

use App\Extensions\RabbitMQ\Services\QueueService;
use Illuminate\Support\Facades\Facade;

class AMQPQueue extends Facade
{
    protected static function getFacadeAccessor()
    {
        return QueueService::class;
    }
}