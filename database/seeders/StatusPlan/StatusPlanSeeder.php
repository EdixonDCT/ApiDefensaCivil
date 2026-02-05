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
            'name' => 'Aprobado'
        ]);
        StatusPlan::create([
            'name' => 'Proceso'
        ]);
        StatusPlan::create([
            'name' => 'Rechazado Cambios'
        ]);
        StatusPlan::create([
            'name' => 'Rechazado Total'
        ]);
        StatusPlan::create([
            'name' => 'Incompleto'
        ]);
    }
}
