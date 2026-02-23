<?php

namespace Database\Seeders\Organization;

use Illuminate\Database\Seeder;
use App\Models\Organization\Organization;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $organizations = [
            ['name' => 'Grupo Santander 1', 'sectional_id' => 1],
            ['name' => 'Grupo San Andres 1', 'sectional_id' => 2],
            ['name' => 'Grupo Caqueta 1', 'sectional_id' => 3],
            ['name' => 'Grupo Meta 1', 'sectional_id' => 4],
        ];

        foreach ($organizations as $orgData) {
            $organization = Organization::create($orgData);

            // Crear auditoría
            $organization->audits()->create([
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
