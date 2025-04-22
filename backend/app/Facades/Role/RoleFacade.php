<?php 

namespace App\Facades\Role;

use App\Services\Role\RoleService;
use Illuminate\Support\Facades\Facade;

class RoleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RoleService::class;
    }
}