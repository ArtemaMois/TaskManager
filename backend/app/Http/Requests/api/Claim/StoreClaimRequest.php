<?php

namespace App\Http\Requests\api\Claim;

use Illuminate\Foundation\Http\FormRequest;

class StoreClaimRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'max:300'],
            'file' => ['nullable', 'mimes:pdf,docx,png,jpeg,jpg', 'max:3048'],
            'category' => ['required', 'exists:categories,slug'],
        ];

    }

    public function messages()
    {
        return [
            'description.required' => 'Требуется ввести описание к заявке.',
            'description.string' => 'Описание должно быть строкой.',
            'description.max' => 'Описание не может быть длиннее 300 символов.',
            'file.mimes' => 'Разрешается загружать файлы формата pdf, docx, png, jpeg, jpg.',
            'file.max' => 'Максимальный размер файла - 3 МБ.',
            'category.required' => 'Требуется выбрать категорию',
            'category.exists' => 'Такой категории не существует'
        ];
    }

}
