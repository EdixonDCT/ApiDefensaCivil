<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario 1 - Admin
        $edixon = User::firstOrCreate(
            ['email' => 'edixon@gmail.com'],
            [
                'password' => 'Edixon10?', // el modelo la hashea
                'state_user_id' => 1
            ]
        );
        $edixon->assignRole('Administrador');

        // Usuario 2 - Voluntario
        $bruno = User::firstOrCreate(
            ['email' => 'bruno@gmail.com'],
            [
                'password' => 'Edixon10?',
                'state_user_id' => 1
            ]
        );
        $bruno->assignRole('Voluntario');

        // Usuario 3 - Voluntario (inactivo)
        $dann = User::firstOrCreate(
            ['email' => 'dann@gmail.com'],
            [
                'password' => 'Edixon10?',
                'state_user_id' => 1
            ]
        );
        $dann->assignRole('Supervisor');

        // Usuario 4 - Invitado
        $prueba = User::firstOrCreate(
            ['email' => 'prueba@gmail.com'],
            [
                'password' => 'Edixon10?',
                'state_user_id' => 3
            ]
        );
        $prueba->assignRole('Super Administrador');
    }
}
