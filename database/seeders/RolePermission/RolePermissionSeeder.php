<?php

namespace Database\Seeders\RolePermissionSeeder;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::findByName('Super Administrador');
        $admin      = Role::findByName('Administrador');
        $supervisor = Role::findByName('Supervisor');
        $voluntario = Role::findByName('Voluntario');

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMINISTRADOR → TODO
        |--------------------------------------------------------------------------
        */
        $superAdmin->syncPermissions(Permission::all());

        /*
        |--------------------------------------------------------------------------
        | ADMINISTRADOR → TODO MENOS CONTROL TOTAL
        |--------------------------------------------------------------------------
        */
        $admin->syncPermissions(
            Permission::whereNotIn('name', [
                'roles.index',
                'roles.store',
                'roles.update',
                'roles.destroy',
                'permissions.index',
                'permissions.store',
                'permissions.update',
                'permissions.destroy',
            ])->get()
        );

        /*
        |--------------------------------------------------------------------------
        | SUPERVISOR → REVISA, ACTUALIZA, CAMBIA ESTADOS
        |--------------------------------------------------------------------------
        */
        $supervisor->syncPermissions([

            // Lecturas generales
            'users.index', 'users.show',
            'profiles.index', 'profiles.show',
            'organizations.index', 'organizations.show',
            'cities.index', 'cities.show',
            'zones.index', 'zones.show',
            'sectors.index', 'sectors.show',
            'apartments.index', 'apartments.show',

            // Planes familiares
            'family-plans.index',
            'family-plans.show',
            'family-plans.update',
            'family-plans.partial-update',
            'family-plans.change-state',
            'family-plans.identify',
            'family-plans.georeference',

            // Vivienda
            'housing-info.index',
            'housing-info.show',

            // Catálogos (gestión)
            'genders.index', 'genders.update', 'genders.change-state',
            'document-types.index', 'document-types.update', 'document-types.change-state',
            'housing-qualities.index', 'housing-qualities.update', 'housing-qualities.change-state',
            'status-plans.index', 'status-plans.update',
        ]);

        /*
        |--------------------------------------------------------------------------
        | VOLUNTARIO → REGISTRA Y CONSULTA
        |--------------------------------------------------------------------------
        */
        $voluntario->syncPermissions([

            // Catálogos (solo lectura)
            'genders.index',
            'document-types.index',
            'cities.index',
            'zones.index',
            'sectors.index',
            'housing-qualities.index',
            'status-plans.index',

            // Plan familiar
            'family-plans.index',
            'family-plans.show',
            'family-plans.store',

            // Vivienda
            'housing-info.store',

            // Perfil propio
            'profiles.show',
            'profiles.update',
        ]);
    }
}
