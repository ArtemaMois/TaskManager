<?php

namespace App\Http\Requests\api\Password;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:3'],
            'password_confirmation' => ['required', 'same:password']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Требуется email',
            'email.email' => 'Email должен соответствовать виду hello@world.com',
            'email.exists' => 'Пользователь с таким email не найден',
            'password.required' => 'Требуется ввести пароль',
            'password.min' => 'Пароль должен быть не менее 3 символов',
            'password_confirmation.required' => 'Требуется подтвердить пароль',
            'password_confirmation.same' => 'Пароли должны совпадать',
        ];
    }
}
