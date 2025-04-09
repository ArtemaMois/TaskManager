<?php

namespace App\Http\Requests\api\Grade;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskGradeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'stars' => ['required', 'integer', 'min:1', 'max:5']
        ];
    }

    public function messages()
    {
        return [
            'stars.required' => 'Требуется оценка задачи (от 1 до 5)',
            'stars.integer' => 'Оценка должна быть числом',
            'stars.min' => 'Оценка не может быть меньше 1',
            'stars.max' => 'Оценка не может быть больше 5'
        ];
    }
}
