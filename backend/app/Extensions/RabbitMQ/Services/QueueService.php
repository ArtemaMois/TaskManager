<?php 

namespace App\Extensions\RabbitMQ\Services;

use App\Console\Commands\RabbitmqInit;
use App\Extensions\RabbitMQ\Exceptions\NotFoundQeueuException;
use App\Extensions\RabbitMQ\DTO\Queue;
use App\Extensions\RabbitMQ\Facades\RabbitMQConnection;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class QueueService
{
    private $queues = [];

    private AMQPStreamConnection $connecton;
    private AMQPChannel $channel;

    public function __construct()
    {
        $this->connecton = RabbitMQConnection::getConnection();
        $this->channel = RabbitMQConnection::getChannel();
    }

    public function queue_declare(string $queueName, bool $durable = true, bool $exclusive = false, bool $auto_delete = false)
    {
        $queue = Queue::make($queueName, $durable, $exclusive, $auto_delete);
        $this->saveQueue($queue);
        $this->channel->queue_declare($queueName, false, $durable, $exclusive, $auto_delete);
    }
    
    private function saveQueue(Queue $queue)
    {
        $this->queues[$queue->name()] = $queue;
    }

    public function bindQueue(string $queue, string $exchange, string $routing_key)
    {
        if(!$this->checkQueue($queue)){
            throw new NotFoundQeueuException();
        }   
        $bind = ($this->queues[$queue])->getBinds();
        $bind->bindExchange($exchange, $routing_key);
        $this->channel->queue_bind($queue, $exchange, $routing_key);
    }

    private function checkQueue(string $queue)
    {
        return in_array($queue, array_keys($this->queues)) ? $this->queues[$queue] : false;
    }

    public function unbind_Exhcange(string $exchange, string $queue)
    {
        if(!$this->checkQueue($queue)){
            throw new NotFoundQeueuException();
        }

        $this->queues[$queue]->getBinds()->unbindExchange($exchange);
        // $this->channel->queue_unbind();
    }
}