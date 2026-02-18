<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación de modelos para la gestión de jerarquía y perfiles.
 */
use App\Models\Profile\Profile;
use App\Models\Sectional\Sectional;
use App\Models\Audit\Audit; // 🔹 IMPORTANTE

/**
 * Clase Organization
 *
 * Este modelo representa las entidades, oficinas o fundaciones que operan 
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
        'name',         
        'is_active',    
        'sectional_id'
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     */
    public function profile()
    {
        return $this->hasMany(Profile::class, 'organization_id');
    }

    /**
     * --- RELACIÓN BELONGS TO (Muchos a Uno) ---
     */
    public function sectional()
    {
        return $this->belongsTo(Sectional::class, 'sectional_id');
    }

    /**
     * --- RELACIÓN POLIMÓRFICA PARA HISTORIAL (AUDIT) ---
     * Permite que esta organización tenga múltiples registros
     * en la tabla audits mediante la relación morphMany.
     */
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }
}
