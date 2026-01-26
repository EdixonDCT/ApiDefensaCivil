<?php

namespace App\Models\Sector;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación del modelo FamilyPlan para establecer la relación de integridad.
 */
use App\Models\FamilyPlan\FamilyPlan;

/**
 * Clase Sector
 * * Este modelo gestiona el catálogo de sectores. Permite agrupar los planes 
 * familiares bajo una categoría específica para análisis estadísticos y 
 * segmentación de intervenciones sociales.
 */
class Sector extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id', 
        'name',      // Nombre del sector (ej: 'Comuna 1', 'Sector Norte', 'Vereda Central')
        'is_active'  // Control de estado lógico para habilitar o deshabilitar la opción
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     * * Un Sector puede estar vinculado a múltiples Planes Familiares.
     * Esta relación es clave para mapear dónde se concentra el trabajo de campo.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familyPlan()
    {
        /**
         * Retorna la colección de planes familiares que pertenecen a este sector.
         */
        return $this->hasMany(FamilyPlan::class, 'sector_id');
    }
}