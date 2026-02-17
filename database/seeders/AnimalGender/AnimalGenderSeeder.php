<?php

namespace Database\Seeders\AnimalGender;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AnimalGender\AnimalGender;

class AnimalGenderSeeder extends Seeder
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