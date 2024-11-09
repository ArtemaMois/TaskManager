<?php

namespace App\Http\Requests\api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'login' => ['required', 'exists:users,login'],
            'password' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Требуется ввести логин',
            'login.exists' => 'Пользователя с таким логином не существует',
            'password.required' => 'Требуется ввести пароль'
        ];
    }
}
