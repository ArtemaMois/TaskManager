<?php

namespace App\Http\Requests\api\Chat;

use Illuminate\Foundation\Http\FormRequest;

class GetPersonalUserChatRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id']
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Требуется идентификатор пользователя',
            'user_id.integer' => 'Передан идентификатор неверного формата',
            'user_id.exists' => 'Пользователь не существует'
        ];
    }
}
