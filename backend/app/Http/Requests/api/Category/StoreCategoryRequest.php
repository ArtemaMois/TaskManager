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

    public function messages()
    {
        return [
            'title.required' => 'Требуется ввести название категории',
            'title.string' => 'Название категории должно быть строкой',
            'title.unique' => 'Категория с таким названием уже существует',
            'slug.required' => 'Требуется ввести название сокращенное название категории',
            'slug.string' => 'Сокращенное название категории должно быть строкой',
            'slug.unique' => 'Категория с таким сокращенным названием уже существует',
            'slug.max' => 'Максимальный размер сокращенного описания категории - 20 символов',
        ];
    }
}
