<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateUserRequest
 * * Valida la actualización de credenciales de usuario (Email y Password).
 * Incluye la excepción de unicidad para el correo y reglas de seguridad de contraseña.
 */
class PartialUpdateUserRequest extends FormRequest
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
     * Define las reglas de validación para la actualización parcial de usuario.
     * * @return array
     */
    public function rules(): array
    {
        /**
         * Capturamos el ID del usuario desde la ruta para la excepción unique.
         */
        $userId = $this->route('user_id');

        return [
            'email'         => "sometimes|email|max:255|unique:users,email,{$userId}",
            'password'      => 'sometimes|min:8|password_security',
            'state_user_id' => 'sometimes|exists:state_users,id',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'email.email'                => 'El :attribute debe ser una dirección válida',
            'email.max'                  => 'El :attribute no debe exceder los :max caracteres',
            'email.unique'               => 'El :attribute ya se encuentra registrado',
            
            'password.min'               => 'La :attribute debe tener al menos :min caracteres',
            'password.password_security' => 'La :attribute debe incluir mayúscula, minúscula, número y carácter especial',
            
            'state_user_id.exists'       => 'El estado de usuario seleccionado no es válido',
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
     * * @return array
     */
    public function attributes(): array
    {
        return [
            'email'         => 'correo electrónico',
            'password'      => 'contraseña',
            'state_user_id' => 'estado de usuario',
        ];
    }
}