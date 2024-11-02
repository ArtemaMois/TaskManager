<?php 

namespace App\Extensions\RabbitMQ\DTO;

use App\Extensions\RabbitMQ\Enums\Exchange\ExchangeEnum;

class Exchange
{

    private function __construct(
        private string $name, 
        private ExchangeEnum $type, 
        private bool $durable, 
        private bool $autoDelete, 
        private string $alternativeExchange='')
    {
        $this->name = $name;
        $this->type = $type;
        $this->durable = $durable;
        $this->autoDelete = $autoDelete;
        $this->alternativeExchange = $alternativeExchange;
    }

    public static function make(string $name, ExchangeEnum $type, bool $durable, bool $autoDelete, string $alternativeExchange=''): Exchange
    {
        return new self($name, $type, $durable, $autoDelete, $alternativeExchange);
    }

    public function name(): string
    {
        return $this->name;
    }
    public function type(): string
    {
        return $this->type->name;
    }

    public function durable(): string
    {
        return $this->durable;
    }

    public function autoDelete(): string
    {
        return $this->autoDelete;
    }

    public function alternativeExchange(): string
    {
        return $this->alternativeExchange;
    }

}