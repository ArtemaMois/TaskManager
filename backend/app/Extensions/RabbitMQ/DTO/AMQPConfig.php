<?php 

namespace App\Extensions\RabbitMQ\DTO;

class AMQPConfig
{
    private function __construct(
        public readonly string $host, 
        public readonly string $port, 
        public readonly string $user, 
        public readonly string $password, 
        public readonly string $vhost, 
    )
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        $this->vhost = $vhost;
    }

    public static function make(): AMQPConfig
    {
        $host = env('RABBITMQ_HOST', '127.0.0.1');
        $port = env('RABBITMQ_PORT', '5672');
        $user = env('RABBITMQ_USER', 'guest');
        $password = env('RABBITMQ_PASSWORD', 'guest');
        $vhost = env('RABBITMQ_VHOST', '/');
        return new self($host, $port, $user, $password, $vhost);
    }
}