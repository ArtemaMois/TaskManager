<?php

namespace App\Http\Requests\api\Grade;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'stars' => ['required', 'integer'],
            'mentor_id' => ['required', 'exists:mentors,id']
        ];
    }

    public function messages()
    {
        return [
            'stars.required' => 'Требуется поставить оценку',
            'stars.integer' => 'Оценка должна быть целым числом',
            'mentor_id.required' => 'Для оценивания требуется идентификатор ментора',
            'mentor_id.exists' => 'Выбраннный ментор не существует'
        ];
    }
}
