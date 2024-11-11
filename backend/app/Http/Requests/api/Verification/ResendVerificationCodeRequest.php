<?php

namespace App\Http\Requests\api\Verification;

use Illuminate\Foundation\Http\FormRequest;

class ResendVerificationCodeRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'email' => ['required', 'exists:users,email', 'email']
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Для подтверждения почты требуется email',
            'email.exists' => 'Пользователь с таким email не найден',
            'email.email' => 'Enail должен соответствовать виду hello@world.com'
        ];
    }
    
}
