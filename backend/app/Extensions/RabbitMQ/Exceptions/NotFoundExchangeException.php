<?php 

namespace App\Extensions\RabbitMQ\Exceptions;

use Exception;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Response;

class NotFoundExchangeException extends Exception
{
    public function render(Request $request)
    {
        return response()->json(['message' => 'Exchange not found']);
    }
}