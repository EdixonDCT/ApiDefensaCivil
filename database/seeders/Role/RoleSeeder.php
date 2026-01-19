<?php

namespace Database\Seeders\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Administrador']);
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Supervisor']);
        Role::create(['name' => 'Voluntario']);
    }
}