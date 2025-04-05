<?php

namespace App\Http\Requests\api\ClaimStatus;

use Illuminate\Foundation\Http\FormRequest;

class StoreClaimStatusRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => ['required', 'max:20', 'unique:claim_statuses,title'],
            'code' => ['required', 'max:20', 'unique:claim_statuses,code']
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Требуется ввести описание статуса заявки',
            'title.max' => 'Максимальный размер описания 20 символов',
            'title.unique' => 'Статус с таким названием уже существует',
            'code.required' => 'Требуется ввести уникальный код заявки',
            'code.max' => 'Максимальный размер уникльного кода 20 символов',
            'code.unique' => 'Статус с таким кодом уже существует'
        ];
    }
}
