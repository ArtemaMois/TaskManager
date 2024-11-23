<?php 

namespace App\Facades\Mentor;

use App\Services\Mentor\MentorService;
use Illuminate\Support\Facades\Facade;

class MentorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MentorService::class;
    }
}