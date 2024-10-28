<?php

namespace Database\Seeders;

use App\Models\Role;
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

    }
}
