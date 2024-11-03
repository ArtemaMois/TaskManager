<?php 

namespace App\Extensions\RabbitMQ\DTO;

use App\Extensions\RabbitMQ\Bindings\QueueBind;

class Queue
{

    private function __construct(
        private string $name,
        private bool $durable, 
        private bool $exclusive,
        private bool $autoDelete
    )
    {
        $this->name = $name;
        $this->durable = $durable;
        $this->exclusive = $exclusive;
        $this->autoDelete = $autoDelete;
    }

    public static function make(string $name, bool $durable, bool $exclusive, bool $autoDelete): Queue
    {
        return new self($name, $durable, $exclusive, $autoDelete);
    }

    public function name()
    {
        return $this->name;
    }

    public function durable()
    {
        return $this->durable;
    }


    public function exclusive()
    {
        return $this->exclusive;
    }

    public function autoDelete()
    {
        return $this->autoDelete;
    }



}