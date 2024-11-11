<?php

namespace App\Http\Requests\api\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'photo' => ['mimes:png,jpeg,jpg,webp', 'max:2048'],
            'login' => ['string', 'max:30'],
        ];
    }

    public function messages()
    {
        return [
            'photo.mimes' => 'Разрешается файлы формата: png,jpeg,jpg,webp',
            'photo.max' => 'Максимальный рамер файла: 2МБ',
            'login.string' => 'Логин должен быть строкой',
            'login.max' => 'Максимальная длина логина - 30 символов'
        ];
    }
}
