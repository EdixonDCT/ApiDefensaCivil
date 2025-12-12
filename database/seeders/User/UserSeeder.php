<?php

namespace Database\Seeders\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'email' => 'edixon@gmail.com',
            'password' => '12345678',
            'state_user_id' => 1
        ]);

        User::create([
            'email' => 'bruno@gmail.com',
            'password' => '12345678',
            'state_user_id' => 1
        ]);

        User::create([
            'email' => 'dann@gmail.com',
            'password' => '12345678',
            'state_user_id' => 2
        ]);

        User::create([
            'email' => 'prueba@gmail.com',
            'password' => '12345678',
            'state_user_id' => 3
        ]);
    }
}
