<?php

namespace Database\Seeders\Action;

use Illuminate\Database\Seeder;
use App\Models\Action\Action;

class ActionSeeder extends Seeder
{
    public function run(): void
    {
        Action::create([
            'name' => 'Creado'
        ]);
        Action::create([
            'name' => 'Enviado'
        ]);
        Action::create([
            'name' => 'Editado'
        ]);
        Action::create([
            'name' => 'Aceptado'
        ]);
        Action::create([
            'name' => 'Rechazado cambios'
        ]);
        Action::create([
            'name' => 'Rechazado total'
        ]);
    }
}
