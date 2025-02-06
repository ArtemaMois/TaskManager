<?php



return [
    App\Providers\AppServiceProvider::class,
    App\Extensions\RabbitMQ\Providers\RabbitMQServiceProvider::class,
    App\Extensions\Centrifugo\Providers\CentrifugoServiceProvider::class
];
