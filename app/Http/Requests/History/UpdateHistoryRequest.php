<?php

namespace App\Http\Requests\History;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateHistoryRequest
 * * Valida la actualización de registros en el historial.
 * Asegura que los cambios mantengan la integridad referencial con usuarios,
 * planes familiares y acciones.
 */
class UpdateHistoryRequest extends FormRequest
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
     * Define las reglas de validación para actualizar el historial.
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id'        => 'required|exists:users,id',
            
            /**
             * CORRECCIÓN: Se cambió 'sectionals' por 'family_plans' 
             * para validar contra la tabla correcta.
             */
            'family_plan_id' => 'required|exists:family_plans,id',
            
            'action_id'      => 'required|exists:actions,id',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin punto final.
     * @return array
     */
    public function messages(): array
    {
        return [
            'user_id.required'        => 'El :attribute es obligatorio',
            'user_id.exists'          => 'El :attribute seleccionado no existe',
            'family_plan_id.required' => 'El :attribute es obligatorio',
            'family_plan_id.exists'   => 'El :attribute seleccionado no es válido',
            'action_id.required'      => 'La :attribute es obligatoria',
            'action_id.exists'        => 'La :attribute seleccionada no existe'
        ];
    }

    /**
     * Define los nombres amigables de los campos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'user_id'        => 'usuario',
            'family_plan_id' => 'plan familiar',
            'action_id'      => 'acción',
        ];
    }
}