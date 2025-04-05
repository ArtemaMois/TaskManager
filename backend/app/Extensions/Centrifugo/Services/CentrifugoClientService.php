<?php 

namespace App\Extensions\Centrifugo\Services;

use App\Extensions\Centrifugo\Connection\CentrifugoConnection;
use Illuminate\Support\Facades\Auth;
use phpcent\Client;

class CentrifugoClientService
{
    public function __construct(
        private CentrifugoConnection $connection
    ) {}

    public function publish(string $channel, array $data)
    {
        return $this->connection->getClient()->publish($channel, $data);
    }

    public function channels()
    {
        return $this->connection->getClient()->channels();
    }


    // public function subscribe(string $channel)
    // {   
    //     return $this->connection->getClient()->subscribe($channel,json_encode(['user' => Auth::user()->id]));
    // }

    public function unsubscribe(string $channel)
    {
        return $this->connection->getClient()->unsubscribe($channel, Auth::user()->id);
    }
}