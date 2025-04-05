<?php 

namespace App\Extensions\Centrifugo\Facades;

use App\Extensions\Centrifugo\Services\CentrifugoService;
use Illuminate\Support\Facades\Facade;

class CentrifugoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CentrifugoService::class;
    }
}