<?php

namespace App\Console\Commands;

use App\Extensions\RabbitMQ\Facades\RabbitMessage;
use App\Extensions\RabbitMQ\Facades\RabbitMQ;
use App\Extensions\RabbitMQ\Facades\RabbitMQConnection;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumeMessage extends Command
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
    protected $description = 'Consume message from queue';


    public function handle()
    {
        while (RabbitMQConnection::getChannel()->is_open()) {

            $callback = function (AMQPMessage $message) {
                $msg = RabbitMessage::deserialize($message->getBody());
                $class = (new $msg['class']($msg['data']))->handle();
            };
            RabbitMQ::consume("verification-email", '', false, true, false, false, $callback);
            RabbitMQ::consume("test", '', false, true, false, false, $callback);
        }
    }
}
