<?php

namespace App\Models\ConditionMember;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ConditionType\ConditionType;
use App\Models\Member\Member;

/**
 * Modelo ConditionMember
 *
 * Representa la relación entre un miembro y un tipo de condición,
 * incluyendo detalles adicionales como nombre y dosis.
 */
class ConditionMember extends Model
{
    use HasFactory;

    /**
     * Atributos que se pueden asignar masivamente (mass assignment)
     *
     * - id: identificador del registro
     * - member_id: referencia al miembro
     * - condition_type_id: referencia al tipo de condición
     * - name: nombre de la condición
     * - dose: dosis o detalle adicional (nullable)
     */
    protected $fillable = [
        'id',
        'member_id',
        'condition_type_id',
        'name',
        'dose'
    ];

    /**
     * Relación con el tipo de condición.
     *
     * Cada ConditionMember pertenece a un ConditionType.
     */
    public function conditionType()
    {
        return $this->belongsTo(ConditionType::class, 'condition_type_id');
    }

    /**
     * Relación con el miembro.
     *
     * Cada ConditionMember pertenece a un Member.
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
