<?php

namespace App\Http\Requests\api\Claim;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClaimRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'claim_status_id' => ['required', 'exists:claim_statuses,id']
        ];
    }

    public function messages()
    {
        return [
            'claim_status_id.required' => 'Требуется указать статус ответа',
            'claim_status_id.exists' => 'Такого статуса не существует'
        ];
    }
}
