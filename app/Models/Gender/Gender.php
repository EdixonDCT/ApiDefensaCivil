<?php

namespace App\Models\Gender;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación del modelo Profile para establecer la relación de integridad.
 */
use App\Models\Profile\Profile;
use App\Models\Audit\Audit;  
/**
 * Clase Gender
 * * Este modelo gestiona el catálogo de géneros (ej. Masculino, Femenino, No Binario)
 * dentro del sistema, permitiendo estandarizar la información demográfica de los usuarios.
 */
class Gender extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * * @var array
     */
    protected $fillable = [
        'id',        // Identificador único (se incluye para inserciones manuales/seeders)
        'name',      // Nombre del género (ej: 'Masculino')
        'is_active'  // Estado lógico: permite habilitar o deshabilitar opciones sin borrar datos
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     * * Un registro de Género puede estar asociado a múltiples perfiles de usuario.
     * Esta relación permite realizar consultas inversas (ej. Saber cuántos hombres hay en el sistema).
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profile()
    {
        /**
         * Retorna todos los registros de la tabla 'profiles' que coincidan
         * con el ID de este género a través de la llave foránea 'gender_id'.
         */
        return $this->hasMany(Profile::class, 'gender_id');
    }
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }

}