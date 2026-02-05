<?php

namespace App\Models\StatusPlan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación del modelo FamilyPlan para establecer la relación de seguimiento.
 */
use App\Models\FamilyPlan\FamilyPlan;

/**
 * Clase StatusPlan
 * * Este modelo gestiona los diferentes estados por los que puede pasar un Plan Familiar.
 * Es la pieza clave para el flujo de trabajo (Workflow), permitiendo clasificar 
 * el progreso de las intervenciones (ej: 'En Diagnóstico', 'Ejecución', 'Finalizado').
 */
class StatusPlan extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id', 
        'name' // Nombre del estado (ej: 'Pendiente', 'Aprobado', 'Rechazado', 'Cerrado')
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     * * Un estado de plan puede estar asignado a múltiples Planes Familiares simultáneamente.
     * Esta relación es vital para la gestión de tableros de control (Dashboards).
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function familyPlan()
    {
        /**
         * Retorna la colección de planes familiares que se encuentran actualmente en este estado.
         */
        return $this->hasMany(FamilyPlan::class, 'status_plan_id');
    }
}