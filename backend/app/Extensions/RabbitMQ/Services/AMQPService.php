<?php

namespace App\Extensions\RabbitMQ\Services;

use App\Extensions\RabbitMQ\Enums\Exchange\ExchangeEnum;
use App\Extensions\RabbitMQ\Facades\RabbitMQConnection;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class AMQPService
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;

    public function __construct()
    {

        $this->connection = RabbitMQConnection::getConnection();
        $this->channel = RabbitMQConnection::getChannel();
    }
    public function declareQueue(string $queue, bool $passive, bool $durable, bool $exclusive, bool $autoDelete)
    {
        $this->channel->queue_declare($queue, $passive, $durable, $exclusive, $autoDelete);
    }

    public function declareExchange(string $exchange, ExchangeEnum $type, bool $passive = false, bool $durable = true, bool $autoDelete = false)
    {
        $this->channel->exchange_declare($exchange, $type->value, $passive, $durable, $autoDelete);
    }

    public function deleteQueue(string $queue)
    {
        $this->channel->queue_delete($queue);
    }

    public function deleteExchange(string $exchange)
    {
        $this->channel->exchange_delete($exchange);
    }

    public function bindQueue(string $queue, string $exchange, string $routingKey, AMQPTable|array $args)
    {
        $this->channel->queue_bind($queue, $exchange, $routingKey, false, $args);
    }

    public function bindExchange(string $destination, string $source, string $routingKey, AMQPTable|array $args)
    {
        $this->channel->exchange_bind($destination, $source, $routingKey, false, $args);
    }

    public function publish(string $message, string $exchange, string $routing_key)
    {
        $msg = $this->makeMessage($message);
        $this->channel->basic_publish($msg, $exchange, $routing_key);
    }

    public function consume(string $queue, string $consumerTag = '', bool $no_local = false, bool $no_ack = true, bool $exclusive = false,  bool $nowait = false, callable $callback)
    {
        $this->channel->basic_consume(
            $queue,
            $consumerTag,
            $no_local,
            $no_ack,
            $exclusive,
            $nowait,
            $callback
        );
        $this->channel->wait();
    }

    private function makeMessage(string $body)
    {
        serialize($body);
        $message = new AMQPMessage($body, []);
        return $message;
    }
}
