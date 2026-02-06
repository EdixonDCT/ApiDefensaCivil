<?php

namespace Database\Seeders\AnimalGenders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalGendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            ['nombre' => 'Macho', 'active' => true],
            ['nombre' => 'Hembra', 'active' => true],
        ];

        DB::table('animal_genders')->insert($genders);
    }
}
