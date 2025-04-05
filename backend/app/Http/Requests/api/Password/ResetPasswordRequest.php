<?php

namespace App\Http\Requests\api\Password;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email']
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Для сброса пароля требуется ввести email',
            'email.email' => 'Email должен соответствовать виду hello@world.com',
            'email.exists' => 'Пользователь с таким email не найден'
        ];
    }
}
