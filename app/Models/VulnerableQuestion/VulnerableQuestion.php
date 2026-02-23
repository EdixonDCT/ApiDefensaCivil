<?php

namespace App\Models\VulnerableQuestion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación de modelos relacionados.
 */
use App\Models\VulnerableTest\VulnerableTest;
use App\Models\Audit\Audit; // 🔹 IMPORTANTE

/**
 * Clase VulnerableQuestion
 *
 * Este modelo gestiona el banco de preguntas de la encuesta de vulnerabilidad.
 */
class VulnerableQuestion extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id',
        'description',
        'question_caution',
        'is_active'
    ];

    /**
     * --- RELACIÓN HAS MANY ---
     * Una pregunta puede tener múltiples respuestas registradas.
     */
    public function vulnerableTest()
    {
        return $this->hasMany(VulnerableTest::class, 'vulnerable_question_id');
    }

    /**
     * --- RELACIÓN POLIMÓRFICA PARA HISTORIAL (AUDIT) ---
     * Permite registrar creación, edición,
     * activación, desactivación o eliminación de la pregunta.
     */
    public function audits()
    {
        return $this->morphMany(Audit::class, 'historiable');
    }
}
