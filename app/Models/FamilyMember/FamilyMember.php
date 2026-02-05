<?php

namespace App\Models\FamilyMember;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Member\Member;

/**
 * Modelo FamilyMembergit
 * Representa la relación entre un miembro y un plan familiar.
 * Es una tabla pivote con lógica propia.
 */
class FamilyMember extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla (opcional, pero claro)
     * @var string
     */
    protected $table = 'family_members';

    /**
     * Atributos asignables masivamente
     * @var array
     */
    protected $fillable = [
        'family_plan_id',
        'member_id',
    ];

    /**
     * Relación Muchos a Uno (Many-to-One)
     * Un registro pertenece a un plan familiar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function familyPlan()
    {
        return $this->belongsTo(FamilyPlan::class, 'family_plan_id');
    }

    /**
     * Relación Muchos a Uno (Many-to-One)
     * Un registro pertenece a un miembro
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    // Relación con el miembro asociado al plan familiar.
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
