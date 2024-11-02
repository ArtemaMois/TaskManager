<?php 

namespace App\Extensions\RabbitMQ\Services;

use App\Extensions\RabbitMQ\Exceptions\NotFoundQeueuException;
use App\Extensions\RabbitMQ\DTO\Queue;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class QueueService
{
    private $queues = [];

    private AMQPStreamConnection $connecton;
    private AMQPChannel $channel;

    public function __construct(AMQPStreamConnection $conn, AMQPChannel $channel)
    {
        $this->connecton = $conn;
        $this->channel = $channel;
    }

    public function queue_declare(string $queueName, bool $durable = true, bool $exclusive = false, bool $auto_delete = false)
    {
        $queue = Queue::make($queueName, $durable, $exclusive, $auto_delete);
        $this->saveQueue($queue);
        $this->channel->queue_declare($queueName, false, $durable, $exclusive, $auto_delete);
    }
    
    private function saveQueue(Queue $queue)
    {
        $this->queues[$queue->name()] = ['queue' => $queue];
    }

    public function bindQueue(string $queue, string $exchange, string $routing_key)
    {
        
        $this->channel->queue_bind($queue, $exchange, $routing_key);
    }

    private function checkQueue(string $queue)
    {
        return in_array($queue, array_keys($this->queues)) ? $this->queues[$queue] : false;
    }

    private function upgradeQueue()
    {
        
    }
}