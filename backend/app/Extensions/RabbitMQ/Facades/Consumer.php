<?php 

namespace App\Extensions\RabbitMQ\Facades;

use App\Extensions\RabbitMQ\Services\ConsumerService;
use Illuminate\Support\Facades\Facade;

class Consumer extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ConsumerService::class;
    }
}