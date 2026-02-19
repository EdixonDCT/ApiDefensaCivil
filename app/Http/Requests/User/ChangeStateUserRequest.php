<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChangeStateGenderRequest
 * * Controla la activación o desactivación lógica de los registros de género.
 * Esto permite deshabilitar opciones sin comprometer la integridad referencial de los perfiles.
 */
class ChangeStateUserRequest extends FormRequest
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
            'state_user_id' => 'required|exists:state_users,id',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'state_user_id.required'     => 'El :attribute es obligatorio',
            'state_user_id.exists'       => 'El :attribute seleccionado no es válido',
        ];
    }

    /**
     * Define el nombre amigable del atributo.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'state_user_id' => 'estado de usuario',
        ];
    }
}