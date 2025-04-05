<?php

namespace App\Services\Category;

use App\Models\Category;

class CategoryService
{
    public function getCategoryBySlug(string $slug): ?Category 
    {
        $category = Category::query()->where('slug', $slug)->first();
        return $category;
    }
}
