<?php 

namespace App\Extensions\Centrifugo\Services;

use App\Extensions\Centrifugo\Connection\CentrifugoConnection;
use phpcent\Client;

class CentrifugoClientService
{
    public function __construct(
        private CentrifugoConnection $connection
    ) {}

    public function publish(string $channel, array $data)
    {
        $this->connection->getClient()->publish($channel, $data);
    }
}