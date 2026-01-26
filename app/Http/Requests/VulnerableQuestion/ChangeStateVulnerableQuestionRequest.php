<?php

namespace App\Http\Requests\VulnerableQuestion;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChangeStateVulnerableQuestionRequest
 * * Valida el cambio de estado (activar/desactivar) de una pregunta de vulnerabilidad.
 * Es preferible usar 'is_active' en lugar de eliminar registros para mantener 
 * la integridad de las encuestas ya respondidas.
 */
class ChangeStateVulnerableQuestionRequest extends FormRequest
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
     * Define las reglas de validación para el cambio de estado.
     * * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * is_active: Debe ser un valor booleano (true, false, 1, 0, "1", "0").
             */
            'is_active' => 'required|boolean',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'is_active.required' => 'El :attribute es obligatorio',
            'is_active.boolean'  => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Define el nombre amigable del atributo.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'is_active' => 'estado de la pregunta',
        ];
    }
}