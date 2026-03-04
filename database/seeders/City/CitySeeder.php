<?php

namespace Database\Seeders\City;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        City::create([
            'name' => 'Floridablanca',
            'department_id' => 1
        ]);
        City::create([
            'name' => 'Bucaramanga',
            'department_id' => 1
        ]);
        City::create([
            'name' => 'Giron',
            'department_id' => 1
        ]);
        City::create([
            'name' => 'Piedecuesta',
            'department_id' => 1
        ]);
                City::create([
            'name' => 'Chia',
            'department_id' => 2
        ]);
        City::create([
            'name' => 'Soacha',
            'department_id' => 2
        ]);
        City::create([
            'name' => 'Barquisimieto',
            'department_id' => 3
        ]);
        City::create([
            'name' => 'Lara',
            'department_id' => 3
        ]);
    }
}
