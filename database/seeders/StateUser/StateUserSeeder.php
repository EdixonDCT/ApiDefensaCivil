<?php

namespace Database\Seeders\StateUser;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StateUser\StateUser;

class stateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StateUser::create([
            'state' => 'Activo'
        ]);
        StateUser::create([
            'state' => 'Inactivo'
        ]);
        StateUser::create([
            'state' => 'Peticion'
        ]);
        StateUser::create([
            'state' => 'Rechazado'
        ]);
    }
}
