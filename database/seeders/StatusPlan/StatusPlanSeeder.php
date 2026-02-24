<?php

namespace Database\Seeders\StatusPlan;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusPlan\StatusPlan;

class StatusPlanSeeder extends Seeder
{
    public function run(): void
    {
        StatusPlan::create([
            'name' => 'Pendiente'
        ]);
        StatusPlan::create([
            'name' => 'No aplica'   
        ]);
        StatusPlan::create([
            'name' => 'Creado'
        ]);
        StatusPlan::create([
            'name' => 'Enviado'
        ]);
        StatusPlan::create([
            'name' => 'Rechazado Cambios'
        ]);
        StatusPlan::create([
            'name' => 'Rechazado Definitivo'
        ]);
        StatusPlan::create([
            'name' => 'Aprobado'
        ]);
    }
}
