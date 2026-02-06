<?php

namespace Database\Seeders\AnimalGenders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AnimalGender\AnimalGender;

class AnimalGendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AnimalGender::create(['name' => 'Macho']);
        AnimalGender::create(['name' => 'Hembra']);
    }
}