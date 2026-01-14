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
            'apartment_id' => 1
        ]);
        City::create([
            'name' => 'Bucaramanga',
            'apartment_id' => 1
        ]);
        City::create([
            'name' => 'Giron',
            'apartment_id' => 1
        ]);
        City::create([
            'name' => 'Piedecuesta',
            'apartment_id' => 1
        ]);
                City::create([
            'name' => 'Chia',
            'apartment_id' => 2
        ]);
        City::create([
            'name' => 'Soacha',
            'apartment_id' => 2
        ]);
        City::create([
            'name' => 'Barquisimieto',
            'apartment_id' => 3
        ]);
        City::create([
            'name' => 'Lara',
            'apartment_id' => 3
        ]);
    }
}
