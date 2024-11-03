<?php 

namespace App\Extensions\RabbitMQ\Services;

use App\Extensions\RabbitMQ\Contracts\ConnectionContract;
use App\Extensions\RabbitMQ\DTO\AMQPConfig;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPExceptionInterface;

class ConnectionService implements ConnectionContract
{

    private AMQPStreamConnection $connection;

    private AMQPChannel $channel;

    public function __construct()
    {
        $this->connect();
    }
    private function connect()
    {
        $config = AMQPConfig::make();
        $this->connection = new AMQPStreamConnection($config->host(), $config->port(), $config->user(), $config->password());
        $this->channel = $this->connection->channel();
    }

    public function getConnection(): AMQPStreamConnection
    {
        return $this->connection;
    }

    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    public function reconnect()
    {
        $this->connect();
    }


    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }

}