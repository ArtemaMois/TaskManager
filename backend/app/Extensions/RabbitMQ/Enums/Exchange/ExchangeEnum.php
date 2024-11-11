<?php 

namespace App\Extensions\RabbitMQ\Enums\Exchange;

enum ExchangeEnum : string
{
    case Direct = 'direct';
    case Fanout = 'fanout';
    case Topic = 'topic';
    case Headers = 'headers';
    

}