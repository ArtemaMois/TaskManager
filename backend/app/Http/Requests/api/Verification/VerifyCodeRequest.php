<?php

namespace App\Http\Requests\api\Verification;

use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'exists:users,email'],
            'code' => ['required', 'min:6', 'max:6']
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Для проверки кода требуется email',
            'email.exists' => 'ПОльзователь с таким email не найден',
            'code.required' => 'Требуется ввести код',
            'code.min' => 'Код должен быть не короче и не длиннее 6 символов',
            'code.max' => 'Код должен быть не короче и не длиннее 6 символов'
        ];
    }
}
