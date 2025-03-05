<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ClaimStatus;
use App\Models\Role;
use App\Models\Timezone;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        // Role::factory()->create([
        //     'code' => 'admin',
        //     'name' => 'Админ'
        // ]);

        // Role::factory()->create([
        //     'code' => 'mentor',
        //     'name' => 'Ментор'
        // ]);

        // Role::factory()->create([
        //     'code' => 'user',
        //     'name' => 'Пользователь'
        // ]);

        // ClaimStatus::factory()->create([
        //     'title' => 'Принято',
        //     'code' => 'complete'
        // ]);

        // ClaimStatus::factory()->create([
        //     'title' => 'В обработке',
        //     'code' => 'handling'
        // ]);

        // ClaimStatus::factory()->create([
        //     'title' => 'Отклонено',
        //     'code' => 'reject'
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Europe/Kaliningrad",
        //     'value' => "UTC+02:00"
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Europe/Moscow",
        //     'value' => "UTC+03:00"
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Europe/Samara",
        //     'value' => "UTC+04:00"
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Asia/Yekaterinburg",
        //     'value' => "UTC+05:00"
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Asia/Omsk",
        //     'value' => "UTC+06:00"
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Asia/Barnaul",
        //     'value' => "UTC+07:00"
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Asia/Irkutsk",
        //     'value' => "UTC+08:00"
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Asia/Chita",
        //     'value' => "UTC+09:00"
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Asia/Ust-Nera",
        //     'value' => "UTC+10:00"
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Asia/Magadan",
        //     'value' => "UTC+11:00"
        // ]);

        // Timezone::factory()->create([
        //     'code' => "Asia/Anadyr",
        //     'value' => "UTC+12:00"
        // ]);

        // Category::factory()->create([
        //     'title' => 'Веб разработка',
        //     'slug' => 'web'
        // ]);

        // Category::factory()->create([
        //     'title' => 'Android-разработка',
        //     'slug' => 'android'
        // ]);


        // Category::factory()->create([
        //     'title' => 'IOS-разработка',
        //     'slug' => 'ios'
        // ]);

        // Category::factory()->create([
        //     'title' => 'Верстка',
        //     'slug' => 'html-coding'
        // ]);

        // Category::factory()->create([
        //     'title' => 'Backend-разработка',
        //     'slug' => 'backend'
        // ]);

        // Category::factory()->create([
        //     'title' => 'Frontend-разработка',
        //     'slug' => 'frontend'
        // ]);

        // Category::factory()->create([
        //     'title' => 'Разработка игр',
        //     'slug' => 'gamedev'
        // ]);

        // Category::factory()->create([
        //     'title' => 'DevOps',
        //     'slug' => 'devops'
        // ]);

        User::factory()->create([
            'login' => 'timon Petrovich',
            'email' => 'timonEmail@gmail.com',
            'password' => 'password',
            'role_id' => 2
        ]);
        User::factory()->create([
            'login' => 'SuperTimonchick',
            'email' => 'timonLemon@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);
        User::factory()->create([
            'login' => 'Semenovich',
            'email' => 'semchick@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);
        User::factory()->create([
            'login' => 'Ashton',
            'email' => 'Ashton@gmail.com',
            'password' => 'password',
            'role_id' => 2
        ]);
        User::factory()->create([
            'login' => 'Esmond',
            'email' => 'Esmond@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);
        User::factory()->create([
            'login' => 'Yaroslav',
            'email' => 'Yaroslav@gmail.com',
            'password' => 'password',
            'role_id' => 2
        ]);
        User::factory()->create([
            'login' => 'Marcus',
            'email' => 'Marcus@gmail.com',
            'password' => 'password',
            'role_id' => 1
        ]);
        User::factory()->create([
            'login' => 'Dillon',
            'email' => 'Dillon@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);
        User::factory()->create([
            'login' => 'Yury',
            'email' => 'Yury@gmail.com',
            'password' => 'password',
            'role_id' => 2
        ]);
        User::factory()->create([
            'login' => 'Eusebius',
            'email' => 'Eusebius@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);
        User::factory()->create([
            'login' => 'Maxwell',
            'email' => 'Maxwell@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);
        User::factory()->create([
            'login' => 'Rabbie',
            'email' => 'Rabbie@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);
        User::factory()->create([
            'login' => 'Serhii',
            'email' => 'Serhii@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);
        User::factory()->create([
            'login' => 'Jeffery',
            'email' => 'Jeffery@gmail.com',
            'password' => 'password',
            'role_id' => 2
        ]);
        User::factory()->create([
            'login' => 'Anatoliy',
            'email' => 'Anatoliy@gmail.com',
            'password' => 'password',
            'role_id' => 3
        ]);

    }
}
