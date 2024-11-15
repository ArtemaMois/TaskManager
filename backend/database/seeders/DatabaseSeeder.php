<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Timezone;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        Role::factory()->create([
            'code' => 'admin',
            'name' => 'Админ'
        ]);

        Role::factory()->create([
            'code' => 'mentor',
            'name' => 'Ментор'
        ]);

        Role::factory()->create([
            'code' => 'user',
            'name' => 'Пользователь'
        ]);
        Timezone::factory()->create([
            'code' => "Europe/Kaliningrad",
            'value' => "UTC+02:00"
        ]);

        Timezone::factory()->create([
            'code' => "Europe/Moscow",
            'value' => "UTC+03:00"
        ]);

        Timezone::factory()->create([
            'code' => "Europe/Samara",
            'value' => "UTC+04:00"
        ]);

        Timezone::factory()->create([
            'code' => "Asia/Yekaterinburg",
            'value' => "UTC+05:00"
        ]);

        Timezone::factory()->create([
            'code' => "Asia/Omsk",
            'value' => "UTC+06:00"
        ]);

        Timezone::factory()->create([
            'code' => "Asia/Barnaul",
            'value' => "UTC+07:00"
        ]);

        Timezone::factory()->create([
            'code' => "Asia/Irkutsk",
            'value' => "UTC+08:00"
        ]);

        Timezone::factory()->create([
            'code' => "Asia/Chita",
            'value' => "UTC+09:00"
        ]);

        Timezone::factory()->create([
            'code' => "Asia/Ust-Nera",
            'value' => "UTC+10:00"
        ]);

        Timezone::factory()->create([
            'code' => "Asia/Magadan",
            'value' => "UTC+11:00"
        ]);

        Timezone::factory()->create([
            'code' => "Asia/Anadyr",
            'value' => "UTC+12:00"
        ]);

    }
}
