<?php 

namespace App\Extensions\RabbitMQ\Providers;

use App\Extensions\RabbitMQ\Services\AMQPService;
use App\Extensions\RabbitMQ\Services\ConnectionService;
use App\Extensions\RabbitMQ\Services\AMQPMessageService;
use Carbon\Laravel\ServiceProvider;

class RabbitMQServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ConnectionService::class, function () {
            return new ConnectionService();
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
