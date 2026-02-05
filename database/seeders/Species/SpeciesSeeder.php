<?php

namespace Database\Seeders\Species;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $species = [
            ['name' => 'Perro', 'active' => true],
            ['name' => 'Gato', 'active' => true],
            ['name' => 'Conejo', 'active' => true],
            ['name' => 'Hamster', 'active' => true],
        ];

        DB::table('species')->insert($species);
    }
}
