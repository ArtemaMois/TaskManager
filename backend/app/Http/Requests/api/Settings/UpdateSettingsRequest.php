<?php

namespace App\Http\Requests\api\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'language_id' => ['integer', 'exists:languages,id'],
            'timezone_id' => ['integer', 'exists:timezones,id'],
            'follow_notifications' ['boolean'],
            'task_notifications' => ['boolean']
        ];
    }
}
