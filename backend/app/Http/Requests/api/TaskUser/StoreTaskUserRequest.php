<?php

namespace App\Http\Requests\api\TaskUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskUserRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'task' => ['required', 'exists:tasks,id'] 
        ];
    }

    public function messages()
    {
        return [
            'task.required' => ['Требуется выбрать задачу'],
            'task.exists' => ['Выбранной задачи не существует']
        ];
    }
}
