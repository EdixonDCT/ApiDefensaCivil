<?php

namespace App\Models\VulnerableQuestion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Importación del modelo VulnerableTest para la relación de resultados.
 */
use App\Models\vulnerableTest\vulnerableTest;

/**
 * Clase VulnerableQuestion
 * * Este modelo gestiona el banco de preguntas de la encuesta de vulnerabilidad.
 * Permite configurar dinámicamente el cuestionario que se aplica a las familias 
 * para determinar su nivel de riesgo socioeconómico.
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
        'description',      // El texto de la pregunta (ej: '¿Cuenta con agua potable?')
        'question_caution', // Advertencia o instrucción para el encuestador
        'is_active'         // Permite habilitar/deshabilitar la pregunta sin borrar datos
    ];

    /**
     * --- RELACIONES HAS MANY (Uno a Muchos) ---
     * * Una pregunta puede tener múltiples respuestas registradas en diferentes tests.
     * Esta relación permite analizar estadísticamente cuáles son las carencias más comunes.
     * * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vulnerableTest()
    {
        /**
         * Retorna la colección de respuestas asociadas a esta pregunta específica.
         */
        return $this->hasMany(vulnerableTest::class, 'vulnerable_question_id');
    }
}