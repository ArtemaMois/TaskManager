<?php

namespace App\Http\Requests\api\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'timezone_id' => ['integer', 'exists:timezones,id'],
            'follow_notifications' => ['boolean'],
            'task_notifications' => ['boolean']
        ];
    }

    public function messages()
    {
        return [
            'timezone_id.integer' => 'Некорректные данные для часового пояса',
            'timezone_id.exists' => 'Такого часового пояса не существует',
            'follow_notifications.boolean' => 'Неверные данные для обновления уведомлений о подписке',
            'task_notifications.boolean' => 'Неверные данные для обновления уведомлений о новой задаче'
        ];
    }
}
