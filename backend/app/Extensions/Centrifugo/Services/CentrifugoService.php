<?php

namespace App\Extensions\Centrifugo\Services;

use App\Extensions\Centrifugo\Connection\CentrifugoConnection;
use Illuminate\Support\Facades\Auth;
use phpcent\Client;

class CentrifugoService
{
    public function __construct(
        private CentrifugoConnection $connection
    ) {}

    public function getClientConnectionToken()
    {
        $userId = Auth::user()->id;
        return $this->connection->getClient()->generateConnectionToken($userId);
    }

    public function getSubscriptionToken(string $channel)
    {
        $userId = Auth::user()->id;
        return $this->connection->getClient()->generateSubscriptionToken($userId, $channel);
    }
}
