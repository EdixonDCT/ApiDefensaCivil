<?php

namespace Database\Seeders\Sectional;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sectional\Sectional;

class SectionalSeeder extends Seeder
{
    public function run(): void
    {
        Sectional::create([
            'name' => 'Santander'
        ]);
        Sectional::create([
            'name' => 'San andres'
        ]);
        Sectional::create([
            'name' => 'Caqueta'
        ]);
        Sectional::create([
            'name' => 'Meta'
        ]);
    }
}
