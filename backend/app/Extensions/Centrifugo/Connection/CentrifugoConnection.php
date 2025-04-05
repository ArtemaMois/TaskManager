<?php 

namespace App\Extensions\Centrifugo\Connection;

use phpcent\Client;

class CentrifugoConnection
{

    private Client $client;
    public function __construct(CentrifugoConfig $config)
    {
        $this->connect($config);
    }
    private function connect(CentrifugoConfig $connection)
    {
        $this->client = new Client($connection->connectionUrl(), $connection->apiKey(), $connection->secret());
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}