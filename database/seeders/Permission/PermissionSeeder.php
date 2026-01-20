<?php

namespace Database\Seeders\Permission;

use App\Models\Permission\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // STATE USERS
            ['home-frontend.voluntario','Vista home del voluntario'],
            ['state-users.index', 'Listar estados de usuario'],
            ['state-users.show', 'Ver estado de usuario'],
            ['state-users.store', 'Crear estado de usuario'],
            ['state-users.update', 'Actualizar estado de usuario'],
            ['state-users.destroy', 'Eliminar estado de usuario'],
            ['users.index', 'Listar usuarios'],
            ['users.show', 'Ver usuario'],
            ['users.store', 'Crear usuario'],
            ['users.update', 'Actualizar usuario'],
            ['users.partial-update', 'Actualizar parcialmente usuario'],
            ['users.destroy', 'Eliminar usuario'],
            // GENDERS
            ['genders.index', 'Listar géneros'],
            ['genders.show', 'Ver género'],
            ['genders.store', 'Crear género'],
            ['genders.update', 'Actualizar género'],
            ['genders.partial-update', 'Actualizar parcialmente género'],
            ['genders.change-state', 'Cambiar estado de género'],
            ['genders.destroy', 'Eliminar género'],

            // DOCUMENT TYPES
            ['document-types.index', 'Listar tipos de documento'],
            ['document-types.show', 'Ver tipo de documento'],
            ['document-types.store', 'Crear tipo de documento'],
            ['document-types.update', 'Actualizar tipo de documento'],
            ['document-types.partial-update', 'Actualizar parcialmente tipo de documento'],
            ['document-types.change-state', 'Cambiar estado del tipo de documento'],
            ['document-types.destroy', 'Eliminar tipo de documento'],

            // SECTIONALS
            ['sectionals.index', 'Listar seccionales'],
            ['sectionals.show', 'Ver seccional'],
            ['sectionals.store', 'Crear seccional'],
            ['sectionals.update', 'Actualizar seccional'],
            ['sectionals.partial-update', 'Actualizar parcialmente seccional'],
            ['sectionals.change-state', 'Cambiar estado de seccional'],
            ['sectionals.destroy', 'Eliminar seccional'],

            // ORGANIZATIONS
            ['organizations.index', 'Listar organizaciones'],
            ['organizations.show', 'Ver organización'],
            ['organizations.store', 'Crear organización'],
            ['organizations.update', 'Actualizar organización'],
            ['organizations.partial-update', 'Actualizar parcialmente organización'],
            ['organizations.change-state', 'Cambiar estado de organización'],
            ['organizations.destroy', 'Eliminar organización'],
            ['organizations.by-sectional', 'Ver organizaciones por seccional'],

            // PROFILES
            ['profiles.index', 'Listar perfiles'],
            ['profiles.show', 'Ver perfil'],
            ['profiles.store', 'Crear perfil'],
            ['profiles.update', 'Actualizar perfil'],
            ['profiles.partial-update', 'Actualizar parcialmente perfil'],
            ['profiles.destroy', 'Eliminar perfil'],

            // ZONES
            ['zones.index', 'Listar zonas'],
            ['zones.show', 'Ver zona'],
            ['zones.store', 'Crear zona'],
            ['zones.update', 'Actualizar zona'],
            ['zones.destroy', 'Eliminar zona'],

            // HOUSING QUALITIES
            ['housing-qualities.index', 'Listar calidad de vivienda'],
            ['housing-qualities.show', 'Ver calidad de vivienda'],
            ['housing-qualities.store', 'Crear calidad de vivienda'],
            ['housing-qualities.update', 'Actualizar calidad de vivienda'],
            ['housing-qualities.partial-update', 'Actualizar parcialmente calidad de vivienda'],
            ['housing-qualities.change-state', 'Cambiar estado de calidad de vivienda'],
            ['housing-qualities.destroy', 'Eliminar calidad de vivienda'],

            // SECTORS
            ['sectors.index', 'Listar sectores'],
            ['sectors.show', 'Ver sector'],
            ['sectors.store', 'Crear sector'],
            ['sectors.update', 'Actualizar sector'],
            ['sectors.partial-update', 'Actualizar parcialmente sector'],
            ['sectors.change-state', 'Cambiar estado de sector'],
            ['sectors.destroy', 'Eliminar sector'],

            // STATUS PLANS
            ['status-plans.index', 'Listar estados de plan'],
            ['status-plans.show', 'Ver estado de plan'],
            ['status-plans.store', 'Crear estado de plan'],
            ['status-plans.update', 'Actualizar estado de plan'],
            ['status-plans.destroy', 'Eliminar estado de plan'],

            // APARTMENTS
            ['apartments.index', 'Listar apartamentos'],
            ['apartments.show', 'Ver apartamento'],
            ['apartments.store', 'Crear apartamento'],
            ['apartments.update', 'Actualizar apartamento'],
            ['apartments.partial-update', 'Actualizar parcialmente apartamento'],
            ['apartments.change-state', 'Cambiar estado de apartamento'],
            ['apartments.destroy', 'Eliminar apartamento'],

            // CITIES
            ['cities.index', 'Listar ciudades'],
            ['cities.show', 'Ver ciudad'],
            ['cities.store', 'Crear ciudad'],
            ['cities.update', 'Actualizar ciudad'],
            ['cities.partial-update', 'Actualizar parcialmente ciudad'],
            ['cities.change-state', 'Cambiar estado de ciudad'],
            ['cities.destroy', 'Eliminar ciudad'],
            ['cities.apartments', 'Ver apartamentos por ciudad'],

            // FAMILY PLANS
            ['family-plans.index', 'Listar planes familiares'],
            ['family-plans.show', 'Ver plan familiar'],
            ['family-plans.store', 'Crear plan familiar'],
            ['family-plans.update', 'Actualizar plan familiar'],
            ['family-plans.partial-update', 'Actualizar parcialmente plan familiar'],
            ['family-plans.identify', 'Identificar plan familiar'],
            ['family-plans.georeference', 'Georreferenciar plan familiar'],
            ['family-plans.change-state', 'Cambiar estado de plan familiar'],
            ['family-plans.destroy', 'Eliminar plan familiar'],

            // HOUSING INFO
            ['housing-info.index', 'Listar información de vivienda'],
            ['housing-info.show', 'Ver información de vivienda'],
            ['housing-info.store', 'Crear información de vivienda'],
            ['housing-info.destroy', 'Eliminar información de vivienda'],
        ];

        foreach ($permissions as [$name, $description]) {
            Permission::firstOrCreate(
                ['name' => $name],
                ['description' => $description]
            );
        }
    }
}
