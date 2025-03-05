<?php 

namespace App\Facades\PerformingTask;

use App\Services\PerformingTask\PerformingTaskService;
use Illuminate\Support\Facades\Facade;

class PerformingTaskFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PerformingTaskService::class;
    }
}