<?php

namespace Database\Seeders\Species;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Species\Species;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Species::create(['name' => 'Perro', 'active' => true]);
        Species::create(['name' => 'Gato', 'active' => true]);
        Species::create(['name' => 'Conejo', 'active' => true]);
        Species::create(['name' => 'Hamster', 'active' => true]);
    }
}
