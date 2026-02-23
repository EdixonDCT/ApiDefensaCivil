<?php

namespace Database\Seeders\User;

use Illuminate\Database\Seeder;
use App\Models\User\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'email' => 'edixon@gmail.com',
                'password' => 'Edixon10?',
                'state_user_id' => 1,
                'role' => 'Voluntario',
            ],
            [
                'email' => 'sol@gmail.com',
                'password' => 'Edixon10?',
                'state_user_id' => 1,
                'role' => 'Supervisor',
            ],
            [
                'email' => 'dylan@gmail.com',
                'password' => 'Edixon10?',
                'state_user_id' => 1,
                'role' => 'Administrador',
            ],
        ];

        foreach ($users as $data) {

            $user = User::create([
                'email' => $data['email'],
                'password' => $data['password'], // el modelo la hashea
                'state_user_id' => $data['state_user_id'],
            ]);
            
            // Asignar rol
            $user->assignRole($data['role']);

            // Crear auditoría simulando que lo hizo el sistema
            $user->audits()->create([
                'user_name'      => "Sistema",
                'rol_name'       => "Sistema",
                'date_time'      => now(),
                'action_execute' => 'Creado',
                'status_old'     => null,
                'status_new'     => "Activo",
            ]);
        }
    }
}