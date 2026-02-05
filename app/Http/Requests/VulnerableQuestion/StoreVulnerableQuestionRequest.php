<?php

namespace App\Http\Requests\VulnerableQuestion;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreVulnerableQuestionRequest
 * * Valida la creación de una nueva pregunta de vulnerabilidad.
 * Asegura que la descripción sea única para evitar preguntas redundantes 
 * en el formulario de caracterización.
 */
class StoreVulnerableQuestionRequest extends FormRequest
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
     * Define las reglas de validación para el registro de la pregunta.
     * * @return array
     */
    public function rules(): array
    {
        return [
            'description'      => 'required|string|max:255|unique:vulnerable_questions,description',
            'question_caution' => 'required|boolean',
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
            'description.unique'        => 'Esta :attribute ya se encuentra registrada',
            
            'question_caution.required' => 'El :attribute es obligatorio',
            'question_caution.boolean'  => 'El :attribute debe ser verdadero o falso'
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
            'question_caution' => 'indicador de precaución'
        ];
    }
}