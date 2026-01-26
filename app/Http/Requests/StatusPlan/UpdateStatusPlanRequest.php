<?php

namespace App\Http\Requests\StatusPlan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateStatusPlanRequest
 * * Valida la actualización de un estado de plan existente.
 * Permite mantener el mismo nombre al editar gracias a la excepción del ID.
 */
class UpdateStatusPlanRequest extends FormRequest
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
         * Obtenemos el ID de la ruta para que la regla 'unique' no choque 
         * con el registro que estamos editando actualmente.
         */
        $statusPlanId = $this->route('status_plan_id');

        return [
            'name' => "required|alpha_spaces|string|max:50|unique:status_plans,name,{$statusPlanId}",
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'El :attribute es obligatorio',
            'name.alpha_spaces' => 'El :attribute debe contener solo letras y espacios',
            'name.string'       => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'       => 'El :attribute ya se encuentra registrado',
            'name.max'          => 'El :attribute no debe superar los :max caracteres'
        ];
    }

    /**
     * Define el nombre amigable del atributo.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre del estado de plan',
        ];
    }
}