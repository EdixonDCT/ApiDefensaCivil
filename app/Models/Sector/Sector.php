<?php

namespace App\Models\Sector;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación del modelo FamilyPlan para establecer la relación de integridad.
 */
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Audit\Audit; // 🔹 IMPORTANTE

/**
 * Clase Sector
 *
 * Este modelo gestiona el catálogo de sectores.
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
        'name',
        'is_active'
    ];

    /**
     * --- RELACIÓN HAS MANY ---
     * Un sector puede estar vinculado a múltiples planes familiares.
     */
    public function familyPlan()
    {
        return $this->hasMany(FamilyPlan::class, 'sector_id');
    }

    /**
     * --- RELACIÓN POLIMÓRFICA PARA HISTORIAL (AUDIT) ---
     * Permite registrar creación, edición,
     * activación, desactivación o eliminación del sector.
     */
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }
}
