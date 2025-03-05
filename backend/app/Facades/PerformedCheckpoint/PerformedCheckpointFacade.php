<?php 

namespace App\Facades\PerformedCheckpoint;

use App\Services\PerformedCheckpoint\PerformedCheckpointService;
use Illuminate\Support\Facades\Facade;

class PerformedCheckpointFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PerformedCheckpointService::class;
    }
}