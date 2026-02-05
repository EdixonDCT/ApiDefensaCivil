<?php

namespace App\Http\Requests\Gender;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChangeStateGenderRequest
 * * Controla la activación o desactivación lógica de los registros de género.
 * Esto permite deshabilitar opciones sin comprometer la integridad referencial de los perfiles.
 */
class ChangeStateGenderRequest extends FormRequest
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
     * Define las reglas de validación para el cambio de estado.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * Se valida que is_active esté presente y sea un booleano válido.
             */
            'is_active' => 'required|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
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
     * @return array
     */
    public function attributes(): array
    {
        return [
            'is_active' => 'estado del género'
        ];
    }
}