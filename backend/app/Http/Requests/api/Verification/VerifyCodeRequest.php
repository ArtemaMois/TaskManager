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
}
