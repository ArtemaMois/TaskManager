<?php 

namespace App\Extensions\RabbitMQ\Facades;

use App\Extensions\RabbitMQ\Services\ConnectionService;
use Illuminate\Support\Facades\Facade;
use SebastianBergmann\CodeCoverage\StaticAnalysisCacheNotConfiguredException;

class RabbitMQConnection extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ConnectionService::class;
    }
}