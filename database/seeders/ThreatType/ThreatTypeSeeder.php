<?php

namespace Database\Seeders\ThreatType;

use Illuminate\Database\Seeder;
use App\Models\ThreatType\ThreatType;

class ThreatTypeSeeder extends Seeder
{
    public function run(): void
    {
        ThreatType::create([
            'name' => 'Inundación'
        ]);
        ThreatType::create([
            'name' => 'Deslizamiento'
        ]);
        ThreatType::create([
            'name' => 'Creciente Súbita'
        ]);
        ThreatType::create([
            'name' => 'Caída Colapso Estructural'
        ]);
        ThreatType::create([
            'name' => 'Contaminación Plagas'
        ]);
        ThreatType::create([
            'name' => 'Caída de árboles rocas'
        ]);
        ThreatType::create([
            'name' => 'Colapso Estructural Traumas Quemaduras'
        ]);
        ThreatType::create([
            'name' => 'Riesgo de Accidentes'
        ]);
        ThreatType::create([
            'name' => 'Otro'
        ]);
    }
}
