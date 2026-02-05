<?php

namespace Database\Seeders\Sector;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sector\Sector;

class SectorSeeder extends Seeder
{
    public function run(): void
    {
        Sector::create([
            'name' => 'Barrio'
        ]);
        Sector::create([
            'name' => 'Comuna'
        ]);
        Sector::create([
            'name' => 'Localidad'
        ]);
    }
}
