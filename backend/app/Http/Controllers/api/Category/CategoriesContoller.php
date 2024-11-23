<?php

namespace App\Http\Controllers\api\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\Category\StoreCategoryRequest;
use App\Http\Resources\api\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesContoller extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success', 'categories' => CategoryResource::collection(Category::all())]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::query()->create($request->validated());
        return response()->json(['status' => 'success', 'category' => new CategoryResource($category)]);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return response()->noContent();   
    }
}
