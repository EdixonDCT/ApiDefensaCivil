<?php

namespace App\Models\Zone;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación del modelo FamilyPlan para establecer la relación geográfica.
 */
use App\Models\FamilyPlan\FamilyPlan;

/**
 * Clase Zone
 * * Este modelo define las grandes áreas o regiones geográficas (ej: Urbana, Rural).
 * Es un nivel de clasificación macro que ayuda a segmentar la ubicación de las familias.
 */
class Zone extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id', 
        'name' // Nombre de la zona (ej: 'Urbana', 'Rural', 'Residencial', 'Industrial')
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     * * Una zona puede albergar múltiples Planes Familiares.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familyPlan()
    {
        /**
         * CORRECCIÓN TÉCNICA: 
         * Se cambió 'status_plan_id' por 'zone_id'.
         * Vincula esta zona con todos los planes familiares que se encuentran en ella.
         */
        return $this->hasMany(FamilyPlan::class, 'zone_id');
    }
}