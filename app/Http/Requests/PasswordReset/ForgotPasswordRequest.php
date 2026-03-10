<?php

namespace App\Http\Requests\PasswordReset;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validación **SOLICITUD** restablecimiento contraseña.
 *
 * Recibe el correo del usuario para enviarle el código.
 * Reglas: email requerido y con formato válido.
 */
class ForgotPasswordRequest extends FormRequest
{
    /**
     * Autoriza todos los usuarios (no requiere autenticación).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación (FORGOT).
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }

    /**
     * Mensajes de error personalizados (español).
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El :attribute es obligatorio.',
            'email.email'    => 'El :attribute debe tener formato válido.',
        ];
    }

    /**
     * Atributos legibles en errores.
     */
    public function attributes(): array
    {
        return [
            'email' => 'correo electrónico',
        ];
    }
}
