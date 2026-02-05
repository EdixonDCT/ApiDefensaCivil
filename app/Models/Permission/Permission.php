<?php

namespace App\Models\Permission;

/**
 * Se extiende el modelo original de Spatie para mantener toda la funcionalidad 
 * del paquete (Spatie Laravel-Permission) pero permitiendo personalizaciones.
 */
use Spatie\Permission\Models\Permission as SpatiePermission;

/**
 * Clase Permission
 * * Este modelo gestiona las acciones específicas que un usuario tiene permitido 
 * ejecutar (ej. 'crear-plan', 'editar-usuarios').
 */
class Permission extends SpatiePermission
{
    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * * Se añaden los campos base de Spatie más la columna personalizada de descripción.
     * @var array
     */
    protected $fillable = [
        'name',        // Nombre técnico del permiso (ej: 'family-plan.create')
        'guard_name',  // Definición del guard (normalmente 'web' o 'api')
        'descripcion', // Explicación amigable de qué hace este permiso (¡Revisa si es description!)
    ];
}