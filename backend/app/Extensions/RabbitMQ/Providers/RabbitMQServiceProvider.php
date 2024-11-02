<?php 

namespace App\Extensions\RabbitMQ\Providers;

use App\Extensions\RabbitMQ\Facades\RabbitMQConnection;
use App\Extensions\RabbitMQ\Services\ConnectionService;
use App\Extensions\RabbitMQ\Services\ExchangeService;
use App\Extensions\RabbitMQ\Services\QueueService;
use Carbon\Laravel\ServiceProvider;

class RabbitMQServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ConnectionService::class, function () {
            return new ConnectionService();
        });
        $this->app->singleton(ExchangeService::class, function ($app) {
            return new ExchangeService(RabbitMQConnection::getConnection(), RabbitMQConnection::getChannel());
        });

        $this->app->singleton(QueueService::class, function ($app) {
            return new QueueService(RabbitMQConnection::getConnection(), RabbitMQConnection::getChannel());
        });
    }

    public function boot()
    {
        
    }
}
