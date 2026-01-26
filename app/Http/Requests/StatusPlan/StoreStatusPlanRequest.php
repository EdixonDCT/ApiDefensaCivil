<?php

namespace App\Http\Requests\StatusPlan;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreStatusPlanRequest
 * * Valida la creación de un nuevo estado para los planes (ej: "Pendiente", "Aprobado", "En Ejecución").
 * Utiliza la regla alpha_spaces para permitir nombres compuestos.
 */
class StoreStatusPlanRequest extends FormRequest
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
     * Define las reglas de validación para el registro de un estado de plan.
     * * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * name: Obligatorio, único en la tabla status_plans.
             * alpha_spaces: Permite nombres como "En Revisión".
             */
            'name' => 'required|alpha_spaces|string|max:50|unique:status_plans,name',
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
            'name.unique'       => 'El :attribute ingresado ya existe',
            'name.max'          => 'El :attribute no debe superar los :max caracteres'
        ];
    }

    /**
     * Define el nombre amigable del atributo para los mensajes.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre del estado de plan',
        ];
    }
}