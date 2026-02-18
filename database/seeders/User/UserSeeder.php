<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $edixon = User::firstOrCreate(
            ['email' => 'edixon@gmail.com'],
            [
                'password' => 'Edixon10?', // el modelo la hashea
                'state_user_id' => 1
            ]
        );
        // $edixon->assignRole('Administrador');
        $edixon->assignRole('Voluntario');

        $bruno = User::firstOrCreate(
            ['email' => 'sol@gmail.com'],
            [
                'password' => 'Edixon10?',
                'state_user_id' => 1
            ]
        );
        $bruno->assignRole('Supervisor');

        $dann = User::firstOrCreate(
            ['email' => 'dylan@gmail.com'],
            [
                'password' => 'Edixon10?',
                'state_user_id' => 1
            ]
        );
        $dann->assignRole('Administrador');
    }
}
