<?php 

namespace App\Extensions\RabbitMQ\Facades;

use App\Extensions\RabbitMQ\Services\ExchangeService;
use Illuminate\Support\Facades\Facade;

class AMQPExchange extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ExchangeService::class;
    }
}