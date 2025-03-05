<?php

namespace App\Http\Requests\api\Task;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:30'],
            'description' => ['required', 'string', 'max:300'],
            // 'file' => ['file', 'max']
            'checkpoints' => ['required', 'min:2', 'max:10'],
            'category' => ['required', 'exists:categories,id'],
            'iframe' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Требуется ввести заголовок задачи',
            'title.string' => 'Заголовок должен быть строкой',
            'title.max' => 'Максимальная длина заголовка - 30 символов',
            'description.required' => 'Требуется ввести описание задачи',
            'decription.string' => 'Описание должно быть строкой',
            'description.max' => 'Максимальная длина описания - 300 символов',
            'checkpoints.required' => 'Требуется добавить чекпоинты',
            'checkpoints.min' => 'Требуется добавить не менее 2 чекпоинтов',
            'checkpoints.max' => 'Максимальное количество чекпоинтов - 10',
            'category.required' => 'Требуется выбрать категорию',
            'category.exists' => 'Выбранная категория не существует'
        ];
    }
}
