<?php

namespace App\Models\BloodGroup;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Clase BloodGroup
 * Este modelo gestiona los grupos sanguíneos del sistema.
 * Se utiliza como catálogo base para registros médicos y formularios.
 */
class BloodGroup extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id',
        'name' // Ej: A+, O-, AB+
    ];
}
