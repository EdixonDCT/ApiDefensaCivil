<?php

namespace App\Http\Requests\VulnerableQuestion;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateVulnerableQuestionRequest
 * * Valida la edición completa de una pregunta de vulnerabilidad.
 * Incluye la excepción de ID en la descripción para evitar conflictos de unicidad.
 */
class UpdateVulnerableQuestionRequest extends FormRequest
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
     * Define las reglas de validación para la actualización.
     * * @return array
     */
    public function rules(): array
    {
        /**
         * Capturamos el ID de la pregunta desde la ruta para la excepción 'unique'.
         */
        $questionId = $this->route('vulnerableQuestion_id');

        return [
            'description'      => "required|string|max:255|unique:vulnerable_questions,description,{$questionId}",
            'question_caution' => 'required|boolean',
            'is_active'        => 'required|boolean',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'description.required'      => 'La :attribute es obligatoria',
            'description.string'        => 'La :attribute debe ser una cadena de texto válida',
            'description.max'           => 'La :attribute no debe superar los :max caracteres',
            'description.unique'        => 'Esa :attribute ya pertenece a otra pregunta',

            'question_caution.required' => 'El :attribute es obligatorio',
            'question_caution.boolean'  => 'El :attribute debe ser verdadero o falso',

            'is_active.required'        => 'El :attribute es obligatorio',
            'is_active.boolean'         => 'El :attribute debe ser activo o inactivo',
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