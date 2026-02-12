<?php

namespace Database\Seeders\Resource;

use Illuminate\Database\Seeder;
use App\Models\Resource\Resource;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        Resource::create([
            'name' => 'Puesto de Salud - Clinica u Hospital',
            'service' => 'Atención médica y servicios de salud'
        ]);

        Resource::create([
            'name' => 'Estación de Bomberos',
            'service' => 'Atención de incendios y emergencias'
        ]);

        Resource::create([
            'name' => 'Estacion de Policia - CAI',
            'service' => 'Seguridad ciudadana y atención policial'
        ]);

        Resource::create([
            'name' => 'Defensa Civil',
            'service' => 'Gestión de riesgo y atención de desastres'
        ]);

        Resource::create([
            'name' => 'Cruz Roja',
            'service' => 'Atención humanitaria y primeros auxilios'
        ]);

        Resource::create([
            'name' => 'Ejercito Nacional',
            'service' => 'Seguridad y apoyo en emergencias nacionales'
        ]);

        Resource::create([
            'name' => 'Enfermeria',
            'service' => 'Atención básica en salud y primeros auxilios'
        ]);

        Resource::create([
            'name' => 'Extintores',
            'service' => 'Control y prevención de incendios'
        ]);
    }
}
