<?php

namespace Database\Seeders\Apartment;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apartment\Apartment;

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        Apartment::create([
            'name' => 'Santander'
        ]);
        Apartment::create([
            'name' => 'Bogota'
        ]);
        Apartment::create([
            'name' => 'Medellin'
        ]);
    }
}
