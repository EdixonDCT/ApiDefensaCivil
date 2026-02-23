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
            ['home-frontend.supervisor','Vista home del supervisor'],
            ['home-frontend.administrador','Vista home del administrador'],
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
            
            // VULNERABLE QUESTIONS (FALTANTES)
            ['vulnerable-questions.index', 'Listar preguntas de vulnerabilidad'],
            ['vulnerable-questions.paginate', 'Paginar preguntas de vulnerabilidad'],
            ['vulnerable-questions.show', 'Ver pregunta de vulnerabilidad'],
            ['vulnerable-questions.store', 'Crear pregunta de vulnerabilidad'],
            ['vulnerable-questions.update', 'Actualizar pregunta de vulnerabilidad'],
            ['vulnerable-questions.partial-update', 'Actualizar parcialmente pregunta de vulnerabilidad'],
            ['vulnerable-questions.change-state', 'Cambiar estado de pregunta de vulnerabilidad'],
            ['vulnerable-questions.destroy', 'Eliminar pregunta de vulnerabilidad'],

            // VULNERABLE TEST (FALTANTES)
            ['vulnerable-tests.index', 'Listar tests de vulnerabilidad'],
            ['vulnerable-tests.show', 'Ver resultados de test de vulnerabilidad'],
            ['vulnerable-tests.store', 'Registrar respuestas de test de vulnerabilidad'],
            ['vulnerable-tests.destroy', 'Eliminar test de vulnerabilidad'],

            // ACTIONS (FALTANTES)
            ['actions.index', 'Listar acciones'],
            ['actions.show', 'Ver detalle de acción'],
            ['actions.store', 'Crear nueva acción'],
            ['actions.update', 'Actualizar acción'],
            ['actions.destroy', 'Eliminar acción'],

            // HISTORIES (FALTANTES)
            ['histories.index', 'Listar todo el historial'],
            ['histories.show', 'Ver detalle de historial'],
            ['histories.store', 'Crear registro de historial'],
            ['histories.update', 'Actualizar historial'],
            ['histories.partial-update', 'Actualizar parcialmente historial'],
            ['histories.destroy', 'Eliminar historial'],
            ['histories.voluntario', 'Ver historial de acciones por voluntario'],
            ['histories.supervisor', 'Ver historial de acciones por supervisor'],
            ['histories.check-access', 'Validar acceso a planes en el historial'],
        ];

        foreach ($permissions as [$name, $description]) {
            Permission::firstOrCreate(
                ['name' => $name],
                ['description' => $description]
            );
        }
    }
}
