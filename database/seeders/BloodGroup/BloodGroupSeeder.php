<?php

namespace Database\Seeders\BloodGroup;

use Illuminate\Database\Seeder;
use App\Models\BloodGroup\BloodGroup;

class BloodGroupSeeder extends Seeder
{
    public function run(): void
    {
        BloodGroup::create(['name' => 'A+']);
        BloodGroup::create(['name' => 'A-']);
        BloodGroup::create(['name' => 'B+']);
        BloodGroup::create(['name' => 'B-']);
        BloodGroup::create(['name' => 'AB+']);
        BloodGroup::create(['name' => 'AB-']);
        BloodGroup::create(['name' => 'O+']);
        BloodGroup::create(['name' => 'O-']);
    }
}
