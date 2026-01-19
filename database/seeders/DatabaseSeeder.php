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
use Database\Seeders\Sector\SectorSeeder;
use Database\Seeders\StatusPlan\StatusPlanSeeder;
use Database\Seeders\Apartment\ApartmentSeeder;
use Database\Seeders\City\CitySeeder;
use Database\Seeders\Role\RoleSeeder;
use Database\Seeders\Permission\PermissionSeeder;
use Database\Seeders\RolePermission\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            stateUserSeeder::class,
            UserSeeder::class,
            GenderSeeder::class,
            DocumentTypeSeeder::class,
            SectionalSeeder::class,
            OrganizationSeeder::class,
            ProfileSeeder::class,
            ZoneSeeder::class,
            HousingQualitySeeder::class,
            SectorSeeder::class,
            StatusPlanSeeder::class,
            ApartmentSeeder::class,
            CitySeeder::class
        ]);
    }
}
