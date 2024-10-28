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
}
