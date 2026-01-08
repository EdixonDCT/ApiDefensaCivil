<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\StateUser\stateUserSeeder;
use Database\Seeders\User\UserSeeder;
use Database\Seeders\Gender\GenderSeeder;
use Database\Seeders\DocumentType\DocumentTypeSeeder;
use Database\Seeders\Sectional\SectionalSeeder;
use Database\Seeders\Organization\OrganizationSeeder;
use Database\Seeders\Profile\ProfileSeeder;
use Database\Seeders\Zone\ZoneSeeder;
use Database\Seeders\HousingQuality\HousingQualitySeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            stateUserSeeder::class,
            UserSeeder::class,
            GenderSeeder::class,
            DocumentTypeSeeder::class,
            SectionalSeeder::class,
            OrganizationSeeder::class,
            ProfileSeeder::class,
            ZoneSeeder::class,
            HousingQualitySeeder::class
        ]);
    }
}
