<?php

namespace App\Console\Commands;

use App\Extensions\RabbitMQ\Enums\Exchange\ExchangeEnum;
use App\Extensions\RabbitMQ\Facades\RabbitMQ;
use App\Extensions\RabbitMQ\Facades\RabbitMQConnection;
use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitmqInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:init';

    protected $description = 'Make init queue and exchange';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        RabbitMQ::declareExchange('laravel', ExchangeEnum::Direct, false, true, false);
        RabbitMQ::declareQueue('verification-email', false, true, false, false);
        RabbitMQ::declareQueue('test', false, true, false, false);
        RabbitMQ::bindQueue('verification-email', 'laravel', 'verification', []);
        RabbitMQ::bindQueue('test', 'laravel', 'test', []);
    }
}
