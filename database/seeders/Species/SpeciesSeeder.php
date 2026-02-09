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
        Species::create(['name' => 'Perro']);
        Species::create(['name' => 'Gato']);
        Species::create(['name' => 'Conejo']);
        Species::create(['name' => 'Hamster']);
    }
}
