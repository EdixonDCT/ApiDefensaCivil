<?php

namespace Database\Seeders\Gender;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gender\Gender;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        Gender::create([
            'name' => 'Masculino'
        ]);
        Gender::create([
            'name' => 'Femenino'
        ]);
    }
}
