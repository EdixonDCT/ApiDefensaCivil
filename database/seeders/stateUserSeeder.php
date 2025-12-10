<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StateUser;

class stateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StateUser::factory()->create([
            'state' => 'Activo'
        ]);
        StateUser::factory()->create([
            'state' => 'Inactivo'
        ]);
        StateUser::factory()->create([
            'state' => 'Peticion'
        ]);
    }
}
