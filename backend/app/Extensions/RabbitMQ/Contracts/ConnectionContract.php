<?php 

namespace App\Extensions\RabbitMQ\Contracts;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

interface ConnectionContract
{

    public function getConnection(): AMQPStreamConnection;

    public function getChannel(): AMQPChannel;
}