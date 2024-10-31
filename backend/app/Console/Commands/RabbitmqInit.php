<?php

namespace App\Console\Commands;

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
    protected $signature = 'rabbitmq:init';

    protected $description = 'Make init queue and exchange';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $connection = RabbitMQConnection::getConnection();
        $channel = RabbitMQConnection::getChannel();
        $channel->exchange_declare('laravel', 'direct', false, true, false);
        $channel->queue_declare('email', false, false, false, false);
        $channel->queue_bind('email', 'laravel', 'email');
        $channel->close();
        $connection->close();
    }
}
