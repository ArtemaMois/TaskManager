<?php

namespace App\Http\Requests\api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'max:30', 'unique:users,login'],
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required', 'max:16'],
        ];
    }
}
