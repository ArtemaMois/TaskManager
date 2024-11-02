<?php 

namespace App\Extensions\RabbitMQ\Exceptions;

use Exception;
use Illuminate\Http\Request;

class NotFoundQeueuException extends Exception
{
    public function render(Request $request)
    {
        return response()->json(['message' => 'Exchange not found']);
    }
}