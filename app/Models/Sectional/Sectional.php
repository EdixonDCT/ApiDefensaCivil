<?php

namespace App\Models\Sectional;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación de modelos para la gestión de jerarquía territorial y operativa.
 */
use App\Models\Organization\Organization;
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Audit\Audit; // 🔹 IMPORTANTE

/**
 * Clase Sectional
 *
 * Este modelo representa las divisiones administrativas de mayor nivel 
 * (ej: Seccional Bogotá, Seccional Antioquia).
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
        'name',
        'is_active'
    ];

    /**
     * --- RELACIONES HAS MANY ---
     */

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'sectional_id');
    }

    public function familyPlans()
    {
        return $this->hasMany(FamilyPlan::class, 'sectional_id');
    }

    /**
     * --- RELACIÓN POLIMÓRFICA PARA HISTORIAL (AUDIT) ---
     * Permite registrar cambios, activaciones, desactivaciones,
     * eliminaciones o modificaciones de la seccional.
     */
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }


    /* --- SCOPES PERSONALIZADOS --- */

    /**
     * Filtra las seccionales activas.
     * @param mixed $query
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Filtra las seccionales que tienen organizaciones asociadas.
     * @param mixed $query
     */

    public function scopeWithOrganizations($query)
    {
        return $query->has('organizations');
    }
}
