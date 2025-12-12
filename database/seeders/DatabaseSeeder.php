<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\StateUser\stateUserSeeder;
use Database\Seeders\User\UserSeeder;
use Database\Seeders\Gender\GenderSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            stateUserSeeder::class,
            UserSeeder::class,
            GenderSeeder::class
        ]);
    }
}
