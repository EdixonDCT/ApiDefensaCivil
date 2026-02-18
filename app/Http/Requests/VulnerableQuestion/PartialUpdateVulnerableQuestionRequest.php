<?php

namespace App\Http\Requests\VulnerableQuestion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Clase PartialUpdateVulnerableQuestionRequest
 * Valida la actualización parcial de una pregunta de vulnerabilidad.
 * Incluye la excepción de ID en la descripción para evitar conflictos de unicidad.
 */
class PartialUpdateVulnerableQuestionRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para la actualización parcial.
     * @return array
     */
    public function rules(): array
    {
        $questionId = $this->route('vulnerableQuestion_id');

        return [
            'description' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('vulnerable_questions', 'description')->ignore($questionId),
            ],
            'question_caution' => 'sometimes|boolean',
            'is_active'        => 'sometimes|boolean',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'description.string'       => 'La :attribute debe ser una cadena de texto válida',
            'description.max'          => 'La :attribute no debe superar los :max caracteres',
            'description.unique'       => 'Esa :attribute ya pertenece a otra pregunta',

            'question_caution.boolean' => 'El :attribute debe ser verdadero o falso',
            'is_active.boolean'        => 'El :attribute debe ser verdadero o falso',
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
     * @return array
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
