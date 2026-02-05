<?php

namespace App\Models\Kinship;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Clase Kinship
 * Este modelo gestiona los tipos de parentesco del sistema.
 * Se utiliza como catálogo base para relaciones familiares.
 */
class Kinship extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id',
        'name', // Ej: Father, Mother, Brother, Sister, Cousin
    ];
}
