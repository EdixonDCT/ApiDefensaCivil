<?php

namespace Database\Seeders\HousingQuality;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HousingQuality\HousingQuality;

class HousingQualitySeeder extends Seeder
{
    public function run(): void
    {
        HousingQuality::create([
            'name' => 'Propio'
        ]);
        HousingQuality::create([
            'name' => 'Arrendado'
        ]);
        HousingQuality::create([
            'name' => 'Familiar'
        ]);
    }
}
