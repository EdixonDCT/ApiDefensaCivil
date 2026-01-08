<?php

namespace Database\Seeders\Zone;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone\Zone;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        Zone::create([
            'name' => 'Rural'
        ]);
        Zone::create([
            'name' => 'Urbana'
        ]);
    }
}
