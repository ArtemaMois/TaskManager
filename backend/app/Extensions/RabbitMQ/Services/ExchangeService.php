<?php 

namespace App\Extensions\RabbitMQ\Services;

use App\Extensions\RabbitMQ\Bindings\ExchangeBind;
use App\Extensions\RabbitMQ\Enums\Exchange\ExchangeEnum;
use App\Extensions\RabbitMQ\Exceptions\NotFoundExchangeException;
use App\Extensions\RabbitMQ\DTO\Exchange;
use App\Extensions\RabbitMQ\Facades\RabbitMQConnection;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Wire\AMQPTable;

use function PHPSTORM_META\argumentsSet;

class ExchangeService
{
    private $exchanges = [];

    private AMQPStreamConnection $connecton;
    private AMQPChannel $channel;

    public function __construct()
    {
        $this->connecton = RabbitMQConnection::getConnection();
        $this->channel = RabbitMQConnection::getChannel();
    }

    public function declare_exchange(string $exchangeName, ExchangeEnum $type, bool $durable = true, bool $autodelete = false, string $alternativeExchange = '')
    {
        $exchange = Exchange::make($exchangeName, $type, $durable, $autodelete, $alternativeExchange);
        $this->saveExchange($exchange);
        $this->channel->exchange_declare($exchangeName, $type->name, false, $durable, $autodelete);
    }

    private function saveExchange(Exchange $exchange)
    {
        $this->exchanges[$exchange->name()] = $exchange;
    }

    public function remove_exchange(string $name)
    {
        $exchange = $this->checkExchange($name);
        $this->channel->exchange_delete($exchange->name());

    }

    public function checkExchange(string $exchange)
    {
        $items = array_keys($this->exchanges);
        return in_array($exchange, $items) ? $this->exchanges[$exchange] : false;
    }

    public function getExchanges()
    {
        return $this->exchanges;
    }

    public function bindExchange(string $destination, string $source, string $routingKey = '', AMQPTable|array $arguments, ?int $ticket)
    {
        if(!$this->checkExchange($destination) || !$this->checkExchange($source))
        {
            throw new NotFoundExchangeException();
        }
        $this->channel->exchange_bind($destination, $source, $routingKey, false, $arguments);

    }

    public function bindQueue(string $exchange, string $queue, string $routingKey, AMQPTable|array $arguments)
    {
        if(!$this->checkExchange($exchange)){
            throw new NotFoundExchangeException();
        }
        
        $this->channel->queue_bind($queue, $exchange, $routingKey, false, $arguments);
    }

}