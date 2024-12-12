<?php

namespace App\Http\Requests\api\TaskUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserTasksRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'checkpoint' => ['required', 'exists:checkpoints,id']
        ];
    }

    public function messages()
    {
        return [
            'checkpoint.required' => 'Не выбран чекпоинт',
            'checkpoint.exists' => 'Выбранный чекпоинт не существует'
        ];
    }
}
