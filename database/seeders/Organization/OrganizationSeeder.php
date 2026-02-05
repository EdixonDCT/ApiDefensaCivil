<?php

namespace Database\Seeders\Organization;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organization\Organization;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        Organization::create([
            'name' => 'Grupo Santander 1',
            'sectional_id' => 1
        ]);
        Organization::create([
            'name' => 'Grupo San andres 1',
            'sectional_id' => 2
        ]);
        Organization::create([
            'name' => 'Grupo Caqueta 1',
            'sectional_id' => 3
        ]);
        Organization::create([
            'name' => 'Grupo Meta 1',
            'sectional_id' => 4
        ]);
    }
}
