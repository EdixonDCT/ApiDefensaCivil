<?php

namespace App\Models\ConditionType;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ConditionMember\ConditionMember;

/**
 * Modelo ConditionType
 *
 * Representa los distintos tipos de condición disponibles en el sistema.
 * Ejemplos: 'Enfermedad', 'Discapacidad', 'Alergia', etc.
 */
class ConditionType extends Model
{
    use HasFactory;

    /**
     * Atributos que se pueden asignar masivamente (mass assignment)
     *
     * - id: identificador del tipo de condición
     * - name: nombre del tipo de condición
     */
    protected $fillable = ['id', 'name'];

    /**
     * Relación con ConditionMember.
     *
     * Un tipo de condición puede estar asociado a muchos miembros
     * a través de la tabla 'condition_members'.
     */
    public function conditionMember()
    {
        return $this->hasMany(ConditionMember::class, 'condition_type_id');
    }
}
