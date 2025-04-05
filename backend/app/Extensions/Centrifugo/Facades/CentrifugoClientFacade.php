<?php 

namespace App\Extensions\Centrifugo\Facades;

use App\Extensions\Centrifugo\Services\CentrifugoClientService;
use Illuminate\Support\Facades\Facade;

class CentrifugoClientFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CentrifugoClientService::class;
    }
}