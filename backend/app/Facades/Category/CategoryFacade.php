<?php 

namespace App\Facades\Category;

use App\Services\Category\CategoryService;
use Illuminate\Support\Facades\Facade;

class CategoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CategoryService::class;
    }
}