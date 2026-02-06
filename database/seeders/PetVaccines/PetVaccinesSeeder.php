<?php

namespace Database\Seeders\PetVaccines;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetVaccinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vaccines = [
            [
                'name' => 'Vacuna Antirrábica',
                'date' => '2026-01-15',
                'pet_id' => 1,
            ],
            [
                'name' => 'Vacuna Triple Felina',
                'date' => '2026-01-20',
                'pet_id' => 2,
            ],
        ];

        DB::table('pet_vaccines')->insert($vaccines);
    
    }
}
