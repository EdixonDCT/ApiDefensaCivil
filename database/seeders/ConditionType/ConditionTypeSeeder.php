<?php

namespace Database\Seeders\ConditionType;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConditionType\ConditionType;

class ConditionTypeSeeder extends Seeder
{
    public function run(): void
    {
        ConditionType::create([
            'name' => 'Enfermedad'
        ]);
        ConditionType::create([
            'name' => 'Discapacidad'
        ]);
        ConditionType::create([
            'name' => 'Alergia'
        ]);
    }
}
