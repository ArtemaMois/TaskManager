<?php

namespace App\Http\Requests\api\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'unique:categories,title'],
            'slug' => ['required', 'string', 'unique:categories,slug', 'max:20']
        ];
    }
}
