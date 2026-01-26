<?php

namespace App\Http\Requests\VulnerableTest;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreVulnerableTestRequest
 * * Valida el registro de una respuesta específica a una pregunta de vulnerabilidad.
 * Asegura la integridad referencial verificando que la pregunta y el plan existan.
 */
class StoreVulnerableTestRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para el registro del test.
     * * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * vulnerable_question_id: Debe existir en la tabla de preguntas.
             * family_plan_id: Debe existir en la tabla de planes familiares.
             * answer: Resultado booleano de la pregunta.
             */
            'vulnerable_question_id' => 'required|exists:vulnerable_questions,id',
            'family_plan_id'         => 'required|exists:family_plans,id',
            'answer'                 => 'required|boolean',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'vulnerable_question_id.required' => 'La :attribute es obligatoria',
            'vulnerable_question_id.exists'   => 'La :attribute seleccionada no es válida',

            'family_plan_id.required' => 'El :attribute es obligatorio',
            'family_plan_id.exists'   => 'El :attribute seleccionado no es válido',

            'answer.required' => 'La :attribute es obligatoria',
            'answer.boolean'  => 'La :attribute debe ser un valor booleano'
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'vulnerable_question_id' => 'pregunta de vulnerabilidad',
            'family_plan_id'         => 'plan familiar',
            'answer'                 => 'respuesta',
        ];
    }
}