<?php 

namespace App\Extensions\RabbitMQ\Providers;

use App\Extensions\RabbitMQ\Facades\RabbitMQConnection;
use App\Extensions\RabbitMQ\Services\AMQPService;
use App\Extensions\RabbitMQ\Services\ConnectionService;
use App\Extensions\RabbitMQ\Services\ExchangeService;
use App\Extensions\RabbitMQ\Services\QueueService;
use Backend\App\Extensions\RabbitMQ\Services\AMQPMessageService;
use Carbon\Laravel\ServiceProvider;

class RabbitMQServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ConnectionService::class, function () {
            return new ConnectionService();
        });
        $this->app->singleton(ExchangeService::class, function ($app) {
            return new ExchangeService();
        });

        $this->app->singleton(QueueService::class, function ($app) {
            return new QueueService();
        });
        $this->app->singleton(AMQPService::class, function ($app) {
            return new AMQPService();
        });
        $this->app->singleton(AMQPMessageService::class, function ($app)
        {
            return new AMQPMessageService();
        });
    }

    public function boot()
    {
        
    }
}
