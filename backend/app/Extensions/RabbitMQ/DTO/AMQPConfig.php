<?php 

namespace App\Extensions\RabbitMQ\DTO;

class AMQPConfig
{
    private function __construct(
        private string $host, 
        private string $port, 
        private string $user, 
        private string $password, 
        private string $vhost, 
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

    public function host(): string
    {
        return $this->host;
    }

    public function port(): string
    {
        return $this->port;
    }

    public function user(): string
    {
        return $this->user;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function vhost(): string
    {
        return $this->vhost;
    }
}
