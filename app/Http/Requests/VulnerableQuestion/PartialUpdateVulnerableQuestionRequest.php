<?php

namespace App\Http\Requests\VulnerableQuestion;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateVulnerableQuestionRequest
 * * Valida actualizaciones parciales (PATCH) de las preguntas de vulnerabilidad.
 * Al usar 'sometimes', las reglas solo se ejecutan si el campo está presente en la solicitud.
 */
class PartialUpdateVulnerableQuestionRequest extends FormRequest
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
     * Define las reglas de validación para la actualización parcial.
     * * @return array
     */
    public function rules(): array
    {
        return [
            'description'      => 'sometimes|string|max:255',
            'question_caution' => 'sometimes|boolean',
            'is_active'        => 'sometimes|boolean',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'description.string'       => 'La :attribute debe ser una cadena de texto válida',
            'description.max'          => 'La :attribute no debe superar los :max caracteres',

            'question_caution.boolean' => 'La :attribute debe ser verdadero o falso',

            'is_active.boolean'        => 'El :attribute debe ser activo o inactivo',
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'description'      => 'descripción de la pregunta',
            'question_caution' => 'indicador de precaución',
            'is_active'        => 'estado de la pregunta',
        ];
    }
}