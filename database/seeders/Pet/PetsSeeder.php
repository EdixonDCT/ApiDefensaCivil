<?php

namespace Database\Seeders\Pet;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pets = [
            [
                'name' => 'Firulais',
                'breed' => 'Labrador',
                'age' => 3,
                'animal_gender_id' => 1, // Macho
                'species_id' => 1, // Perro
                'family_plan_id' => 1, // Debes tener un plan familiar con id 1
            ],
        ];

        DB::table('pets')->insert($pets);
    }
    
}
