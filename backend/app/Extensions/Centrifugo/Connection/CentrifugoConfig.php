<?php 

namespace App\Extensions\Centrifugo\Connection;

use App\Extensions\Centrifugo\Contracts\ConnectionContract;
use Illuminate\Support\Facades\Config;

class CentrifugoConfig implements ConnectionContract
{
 
    private $host = '';

    private $port = '';

    private $secret = '';

    private $apiKey = '';
    public function __construct()
    {
        $this->host = env('CENTRIFUGO_HOST', 'centrifugo');
        $this->port = env('CENTRIFUGO_PORT', '8427');
        $this->secret = env('CENTRIFUGO_SECRET', 'R0ytHWpYNFbAeN_XIOjUaXG8ik4PrqLE7-G9mQGGxPr4XvGRxadKES9G8EW6c41HTonXfb8PDW76GejKjJOSaA');
        $this->apiKey = env('CENTRIFUGO_API_KEY', 'khHBtd_udr25FpF1v4W_3R_OAsYpp-uch1ZDZdJQAM7YqdvHTJ3D4g7ygkwqznpLmldgG-aKcUOVMdcS4csG_w');
    }
    public function host(): string
    {
        return $this->host;
    }

    public function connectionUrl(bool $secure = false)
    {
        return $secure ? "https://" . $this->host . ":" . $this->port . "/api" : "http://" . $this->host . ":" . $this->port . "/api";
    }
    public function port(): string
    {
        return $this->port;
    }

    public function secret()
    {
        return $this->secret;
    }

    public function apiKey()
    {
        return $this->apiKey;
    }
}
