<?php

namespace App\Http\Requests\api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'max:30', 'unique:users,login'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:3'],
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Требуется ввести логин',
            'login.string' => 'Логин должен быть строкой',
            'login.max' => 'Максимальная длина логина - 30 символов',
            'login.unique' => 'Пользователь с таким логином уже существует',
            'email.required' => 'Требуется ввести email',
            'email.email' => 'Email должен соответствовать виду hello@world.com',
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.required' => 'Требуется ввести пароль',
            'password.min' => 'Минимальная длина пароля - 3 символа' 
        ];
    }
}
