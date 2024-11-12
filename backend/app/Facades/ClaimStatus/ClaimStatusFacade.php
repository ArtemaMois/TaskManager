<?php 

namespace App\Facades\ClaimStatus;

use App\Services\ClaimStatus\ClaimStatusService;
use Illuminate\Support\Facades\Facade;

class ClaimStatusFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ClaimStatusService::class;
    }
}