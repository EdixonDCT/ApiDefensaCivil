<?php

namespace App\Models\HousingQuality;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación del modelo FamilyPlan para establecer la relación de integridad.
 */
use App\Models\FamilyPlan\FamilyPlan;

/**
 * Clase HousingQuality
 * * Este modelo gestiona el catálogo de calidades de vivienda. Permite clasificar
 * técnicamente el estado habitacional de las familias para análisis socioeconómicos.
 */
class HousingQuality extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id', 
        'name',      // Nombre del estado (ej: 'Óptima', 'Requiere mejoras', 'Crítica')
        'is_active'  // Control de estado lógico para habilitar/deshabilitar la opción
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     * * Una categoría de calidad de vivienda puede ser asignada a múltiples Planes Familiares.
     * Esta relación es vital para generar reportes de priorización.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familyPlan()
    {
        /**
         * Retorna la colección de planes familiares que comparten este nivel de calidad.
         */
        return $this->hasMany(FamilyPlan::class, 'housing_quality_id');
    }
}