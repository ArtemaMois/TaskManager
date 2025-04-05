<?php

namespace App\Http\Requests\api\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{

    public function rules(): array
    {
        $rules = [
            'photo' => ['required', 'mimes:png,jpeg,jpg,webp', 'max:2048'],
            'login' => ['string', 'max:30', 'min:3'],
        ];
        if(Auth::user()->role->code != 'user')
        {
            $rules['about_me'] = ['string', 'max:100', 'nullable'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'photo.mimes' => 'Разрешается файлы формата: png,jpeg,jpg,webp',
            'photo.max' => 'Максимальный рамер файла: 2МБ',
            'login.string' => 'Логин должен быть строкой',
            'login.max' => 'Максимальная длина логина - 30 символов',
            'login.min' => 'Минимальная длина логина - 3 символа',
            'about_me.string' => 'Описание должно быть строкой',
            'about_me.max' => 'Описание не может быть больше 100 символов'
        ];
    }
}
