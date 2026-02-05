<?php

namespace Database\Seeders\Action;

use Illuminate\Database\Seeder;
use App\Models\Action\Action;

class ActionSeeder extends Seeder
{
    public function run(): void
    {
        Action::create([
            'name' => 'Crear'
        ]);

        Action::create([
            'name' => 'Editar'
        ]);

        Action::create([
            'name' => 'Desactivar'
        ]);

        Action::create([
            'name' => 'Activar'
        ]);

        Action::create([
            'name' => 'Aceptar'
        ]);

        Action::create([
            'name' => 'Rechazar cambios'
        ]);

        Action::create([
            'name' => 'Rechazar total'
        ]);

        Action::create([
            'name' => 'Proceso'
        ]);
    }
}
