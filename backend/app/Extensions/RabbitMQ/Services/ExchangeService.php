<?php 

namespace App\Extensions\RabbitMQ\Services;

use App\Extensions\RabbitMQ\Enums\Exchange\ExchangeEnum;
use App\Extensions\RabbitMQ\Exceptions\NotFoundExchangeException;
use App\Extensions\RabbitMQ\DTO\Exchange;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Wire\AMQPTable;

class ExchangeService
{
    private $exchanges = [];

    private AMQPStreamConnection $connecton;
    private AMQPChannel $channel;

    public function __construct(AMQPStreamConnection $conn, AMQPChannel $channel)
    {
        $this->connecton = $conn;
        $this->channel = $channel;
    }

    public function declare_exchange(string $exchangeName, ExchangeEnum $type, bool $durable = true, bool $autodelete = false, string $alternativeExchange = '')
    {
        $exchange = Exchange::make($exchangeName, $type, $durable, $autodelete, $alternativeExchange);
        $this->saveExchange($exchange);
        $this->channel->exchange_declare($exchangeName, $type->name, false, $durable, $autodelete);
    }

    private function saveExchange(Exchange $exchange)
    {
        $this->exchanges[$exchange->name()] = ['exchange' => $exchange];
    }

    public function remove_exchange(string $name)
    {
        $exchange = $this->checkExchange($name);
        $this->channel->exchange_delete($exchange->name());

    }

    public function checkExchange(string $exchange)
    {
        $items = array_keys($this->exchanges);
        return in_array($exchange, $items) ? $this->exchanges[$exchange]['exchange'] : false;
    }

    public function getExchanges()
    {
        return $this->exchanges;
    }

    public function bindExchange(string $destination, string $source, string $routingKey = '', AMQPTable $arguments, ?int $ticket)
    {
        if(!$this->checkExchange($destination) || !$this->checkExchange($source))
        {
            throw new NotFoundExchangeException();
        }

        $this->exchanges[$source]['binds']['exchanges'] = $destination; 

    }

}