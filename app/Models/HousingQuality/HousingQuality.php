<?php

namespace App\Models\HousingQuality;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación del modelo FamilyPlan para establecer la relación de integridad.
 */
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Audit\Audit; // 🔹 IMPORTANTE

/**
 * Clase HousingQuality
 *
 * Este modelo gestiona el catálogo de calidades de vivienda.
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
        'name',
        'is_active'
    ];

    /**
     * --- RELACIÓN HAS MANY ---
     * Una categoría puede estar asociada a múltiples planes familiares.
     */
    public function familyPlan()
    {
        return $this->hasMany(FamilyPlan::class, 'housing_quality_id');
    }

    /**
     * --- RELACIÓN POLIMÓRFICA PARA HISTORIAL (AUDIT) ---
     * Permite registrar creación, edición,
     * activación, desactivación o eliminación.
     */
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }
}
