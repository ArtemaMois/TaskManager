<?php

namespace App\Console\Commands;

use App\Extensions\RabbitMQ\Facades\RabbitMessage;
use App\Extensions\RabbitMQ\Facades\RabbitMQ;
use App\Extensions\RabbitMQ\Facades\RabbitMQConnection;
use Illuminate\Console\Command;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitConsume extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Забирает задания из очереди';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        while (RabbitMQConnection::getChannel()->is_open()) {

            $callback = function (AMQPMessage $message) {
                $msg = RabbitMessage::deserialize($message->getBody());
                $class = (new $msg['class']($msg['data']))->handle();
            };
            RabbitMQ::consume("verification-email", '', false, true, false, false, $callback);
        }
    }
}
