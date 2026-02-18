<?php

namespace App\Models\Nationality;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Profile\Profile;
use App\Models\Audit\Audit; // 🔹 IMPORTANTE

/**
 * Clase Nationality
 *
 * Este modelo gestiona el catálogo de nacionalidades.
 */
class Nationality extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva.
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'is_active'
    ];

    /**
     * --- RELACIÓN HAS MANY ---
     * Una nacionalidad puede estar asociada a múltiples perfiles.
     */
    public function profile()
    {
        return $this->hasMany(Profile::class, 'nationality_id');
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
