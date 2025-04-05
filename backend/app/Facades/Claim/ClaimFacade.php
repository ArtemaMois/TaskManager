<?php 

namespace App\Facades\Claim;

use App\Services\Claim\ClaimService;
use Illuminate\Support\Facades\Facade;

class ClaimFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ClaimService::class;
    }
}