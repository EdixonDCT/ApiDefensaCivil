<?php

namespace Database\Seeders\ActionType;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActionType\ActionType;

class ActionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActionType::create(['name' => 'Antes']);
        ActionType::create(['name' => 'Durante']);
        ActionType::create(['name' => 'Despues']);
    }
}