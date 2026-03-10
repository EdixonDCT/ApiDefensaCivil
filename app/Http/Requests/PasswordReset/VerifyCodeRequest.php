<?php

namespace App\Http\Requests\PasswordReset;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Validación **VERIFICACIÓN** código de restablecimiento.
 *
 * El frontend envía el email (guardado en estado) junto al
 * código de 6 dígitos ingresado por el usuario.
 * Reglas: email + código numérico exacto de 6 dígitos.
 */
class VerifyCodeRequest extends FormRequest
{
    /**
     * Autoriza todos los usuarios (no requiere autenticación).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación (VERIFY).
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'code'  => ['required', 'digits:6'],
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
            'code.required'  => 'El :attribute es obligatorio.',
            'code.digits'    => 'El :attribute debe tener exactamente :digits dígitos.',
        ];
    }

    /**
     * Atributos legibles en errores.
     */
    public function attributes(): array
    {
        return [
            'email' => 'correo electrónico',
            'code'  => 'código de verificación',
        ];
    }
}
