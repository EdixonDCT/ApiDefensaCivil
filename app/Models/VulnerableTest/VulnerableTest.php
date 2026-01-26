<?php

namespace App\Models\VulnerableTest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación de modelos para la relación de resultados y pertenencia.
 */
use App\Models\VulnerableQuestion\VulnerableQuestion;
use App\Models\FamilyPlan\FamilyPlan;

/**
 * Clase VulnerableTest
 * * Este modelo registra las respuestas individuales de la encuesta de vulnerabilidad.
 * Funciona como una tabla intermedia con datos adicionales (el campo 'answer') 
 * que vincula cada pregunta del catálogo con un plan familiar específico.
 */
class VulnerableTest extends Model
{
    /** * Se añade el trait HasFactory para permitir el uso de seeders y tests.
     */
    use HasFactory;

    /**
     * Atributos asignables de forma masiva (Mass Assignment).
     * @var array
     */
    protected $fillable = [
        'id',
        'vulnerable_question_id', // ID de la pregunta realizada
        'family_plan_id',         // ID del plan familiar evaluado
        'answer'                  // Valor de la respuesta (ej: true/false o un puntaje)
    ];

    /**
     * --- RELACIONES BELONGS TO (Muchos a Uno) ---
     */

    /**
     * Relación con la Pregunta de Vulnerabilidad.
     * Permite conocer el enunciado y la precaución de la pregunta respondida.
     * * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vulnerableQuestion()
    {
        return $this->belongsTo(VulnerableQuestion::class, 'vulnerable_question_id');
    }

    /**
     * Relación con el Plan Familiar.
     * Identifica a qué grupo familiar pertenece esta respuesta específica.
     * * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function FamilyPlan()
    {
        return $this->belongsTo(FamilyPlan::class, 'family_plan_id');
    }
}