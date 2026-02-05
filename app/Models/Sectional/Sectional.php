<?php

namespace App\Models\Sectional;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación de modelos para la gestión de jerarquía territorial y operativa.
 */
use App\Models\Organization\Organization;
use App\Models\FamilyPlan\FamilyPlan;

/**
 * Clase Sectional
 * * Este modelo representa las divisiones administrativas de mayor nivel (ej: Seccional Bogotá, 
 * Seccional Antioquia). Actúa como el nodo principal del que cuelgan las organizaciones 
 * y donde se consolidan los planes familiares de un territorio.
 */
class Sectional extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id', 
        'name',      // Nombre de la seccional (ej: 'Seccional Occidente')
        'is_active'  // Estado operativo para habilitar/deshabilitar la seccional
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     */

    /**
     * Relación con las Organizaciones.
     * * Una seccional supervisa y agrupa a múltiples organizaciones o fundaciones.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organization()
    {
        return $this->hasMany(Organization::class, 'sectional_id');
    }

    /**
     * Relación con los Planes Familiares.
     * * Permite consolidar todos los planes familiares ejecutados dentro del 
     * territorio de esta seccional, facilitando reportes regionales.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familyPlan()
    {
        return $this->hasMany(FamilyPlan::class, 'sectional_id');
    }
}