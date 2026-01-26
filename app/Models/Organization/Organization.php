<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación de modelos para la gestión de jerarquía y perfiles.
 */
use App\Models\Profile\Profile;
use App\Models\Sectional\Sectional;

/**
 * Clase Organization
 * * Este modelo representa las entidades, oficinas o fundaciones que operan 
 * dentro del sistema. Actúa como un contenedor de usuarios y está vinculada 
 * a una seccional específica para la segmentación de datos.
 */
class Organization extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id', 
        'name',         // Nombre de la organización (ej: 'Fundación Central', 'Oficina Norte')
        'is_active',    // Estado de operatividad de la organización
        'sectional_id'  // ID de la seccional a la que pertenece administrativamente
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     * * Una organización puede tener múltiples perfiles de usuario asociados.
     * Esta relación es clave para el filtrado de datos basado en el origen del usuario.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profile()
    {
        // Conecta la organización con todos los perfiles que pertenecen a ella
        return $this->hasMany(Profile::class, 'organization_id');
    }

    /**
     * --- RELACIONES BELONGS TO (Muchos a Uno) ---
     * * Cada organización pertenece a una única Seccional.
     * Esto permite que el sistema sepa en qué zona geográfica opera esta entidad.
     * * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sectional()
    {
        // Retorna la seccional (padre) que supervisa a esta organización
        return $this->belongsTo(Sectional::class, 'sectional_id');
    }
}