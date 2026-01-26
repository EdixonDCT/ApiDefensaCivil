<?php

namespace App\Http\Requests\History;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreHistoryRequest
 * * Se encarga de validar la creación de un nuevo registro en el historial.
 * Garantiza que la acción quede vinculada correctamente a un usuario y a un plan familiar real.
 */
class StoreHistoryRequest extends FormRequest
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
     * Define las reglas de validación para el almacenamiento del historial.
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id'        => 'required|exists:users,id',
            
            /**
             * CORRECCIÓN: Se cambió 'sectionals' por 'family_plans' 
             * para asegurar la integridad referencial.
             */
            'family_plan_id' => 'required|exists:family_plans,id',
            
            'action_id'      => 'required|exists:actions,id',
        ];
    }

    /**
     * Mensajes de error personalizados.
     * * Usamos :attribute para evitar redundancia y quitamos puntos finales.
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
     * Define los nombres amigables de los atributos.
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