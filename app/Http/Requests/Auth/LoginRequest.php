<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase LoginRequest
 * * Se encarga de validar las credenciales de acceso cuando un usuario intenta iniciar sesión.
 * Filtra que el correo tenga el formato adecuado antes de intentar la autenticación.
 */
class LoginRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * @return bool
     */
    public function authorize(): bool
    {
        // Generalmente true, ya que cualquier usuario (incluso no autenticado) debe poder intentar el login.
        return true;
    }

    /**
     * Define las reglas de validación para el inicio de sesión.
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * Mensajes de error personalizados.
     * * Se usa :attribute para dinamismo y se eliminaron los puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required'    => 'El :attribute es obligatorio',
            'email.email'       => 'El :attribute no tiene el formato correcto',
            'password.required' => 'La :attribute es obligatoria'
        ];
    }

    /**
     * Define los nombres amigables de los campos para los mensajes de error.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'email'    => 'correo electrónico',
            'password' => 'contraseña'
        ];
    }
}