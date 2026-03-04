<?php

namespace Database\Seeders\Department;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        Department::create([
            'name' => 'Santander'
        ]);
        Department::create([
            'name' => 'Bogota'
        ]);
        Department::create([
            'name' => 'Medellin'
        ]);
    }
}
