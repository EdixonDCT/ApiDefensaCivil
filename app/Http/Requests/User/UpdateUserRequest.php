<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateUserRequest
 * * Valida la actualización completa de las credenciales de usuario.
 * Garantiza que el email sea único (exceptuando al usuario actual) 
 * y que la contraseña cumpla con los requisitos de seguridad.
 */
class UpdateUserRequest extends FormRequest
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
     * Define las reglas de validación para la edición de usuario.
     * * @return array
     */
    public function rules(): array
    {
        /**
         * Capturamos el ID del usuario desde la ruta para permitir
         * guardar cambios sin conflicto de unicidad en el email.
         */
        $userId = $this->route('user_id');

        return [
            'email'         => "required|email|max:255|unique:users,email,{$userId}",
            'password'      => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/',
            'state_user_id' => 'required|exists:state_users,id',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * * @return array
     */
    public function messages(): array
    {
        return [
            'email.required'   => 'El :attribute es obligatorio',
            'email.email'      => 'El :attribute debe ser una dirección válida',
            'email.max'        => 'El :attribute no debe superar los :max caracteres',
            'email.unique'     => 'El :attribute ya se encuentra registrado',

            'password.required' => 'La :attribute es obligatoria',
            'password.min'      => 'La :attribute debe tener al menos :min caracteres',
            'password.regex'    => 'La :attribute debe incluir mayúscula, minúscula, número y carácter especial',

            'state_user_id.required' => 'El :attribute es obligatorio',
            'state_user_id.exists'   => 'El :attribute seleccionado no es válido',
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