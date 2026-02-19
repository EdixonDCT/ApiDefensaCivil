<?php

namespace Database\Seeders\Sectional;

use Illuminate\Database\Seeder;
use App\Models\Sectional\Sectional;

class SectionalSeeder extends Seeder
{
    public function run(): void
    {
        $sectionals = [
            ['name' => 'Santander'],
            ['name' => 'San Andres'],
            ['name' => 'Caqueta'],
            ['name' => 'Meta'],
        ];

        foreach ($sectionals as $sectionalData) {
            $sectional = Sectional::create($sectionalData);

            // Crear auditoría simulando que lo hizo el sistema
            $sectional->audits()->create([
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
