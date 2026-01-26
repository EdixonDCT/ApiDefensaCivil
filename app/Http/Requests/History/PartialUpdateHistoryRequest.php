<?php

namespace App\Http\Requests\History;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateHistoryRequest
 * * Valida la actualización de registros en el historial de acciones.
 * Utiliza 'sometimes' para permitir actualizaciones parciales de los vínculos
 * entre usuarios, planes familiares y acciones realizadas.
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
     * Define las reglas de validación para la actualización del historial.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * 'sometimes' permite que los campos sean opcionales.
             * Si se envían, se verifica que existan en sus respectivas tablas.
             */
            'user_id'        => 'sometimes|exists:users,id',
            
            /**
             * CORRECCIÓN: Se cambió 'sectionals' por 'family_plans' 
             * para que coincida con el modelo correspondiente.
             */
            'family_plan_id' => 'sometimes|exists:family_plans,id',
            
            'action_id'      => 'sometimes|exists:actions,id',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'user_id.exists'        => 'El :attribute seleccionado no existe',
            'family_plan_id.exists' => 'El :attribute seleccionado no es válido',
            'action_id.exists'      => 'La :attribute seleccionada no existe en el sistema'
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