<?php

namespace App\Models\Nationality;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Clase Nationality
 * * Este modelo gestiona el catálogo de nacionalidades (ej. Colombiana, Mexicana, Española)
 * dentro del sistema, permitiendo estandarizar la información demográfica de los usuarios.
 */
class Nationality extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * * @var array
     */
    protected $fillable = [
        'id',        // Identificador único (se incluye para inserciones manuales/seeders)
        'name',      // Nombre de la nacionalidad (ej: 'Colombiana')
        'is_active'  // Estado lógico: permite habilitar o deshabilitar opciones sin borrar datos
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     * * Una nacionalidad puede estar asociada a múltiples perfiles de usuario.
     * Esta relación permite realizar consultas inversas (ej. Saber cuántos usuarios son colombianos).
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
}
