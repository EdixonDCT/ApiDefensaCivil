<?php

namespace App\Models\Species;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Pet\Pet;
use App\Models\Audit\Audit; // 🔹 Importar Audit para la relación

class Species extends Model
{
    use HasFactory;

    protected $fillable = ['name','is_active'];

    /**
     * Relación con mascotas
     */
    public function pet()
    {
        return $this->hasMany(Pet::class, 'species_id');
    }

    /**
     * Relación polimórfica con auditoría
     * Permite registrar creación, edición, activación, desactivación o eliminación
     */
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }
}
