<?php

namespace App\Http\Requests\PasswordReset;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as LaravelStrongPassword;

/**
 * Validación **RESETEO** contraseña con código numérico.
 *
 * El frontend envía el email (guardado en estado) + código verificado
 * + nueva contraseña confirmada.
 * Reglas: email + código 6 dígitos + password fuerte confirmado.
 *
 * LaravelStrongPassword::defaults() exige por defecto:
 * - Mínimo 8 caracteres
 * - Al menos una letra y un número
 * Se configura en App\Providers\AppServiceProvider::boot()
 */
class ResetPasswordRequest extends FormRequest
{
    /**
     * Autoriza todos los usuarios (no requiere autenticación).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación (RESET).
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'code'     => ['required', 'digits:6'],
            'password' => ['required', 'string', 'max:50', 'confirmed', LaravelStrongPassword::defaults()],
        ];
    }

    /**
     * Mensajes de error personalizados (español).
     */
    public function messages(): array
    {
        return [
            'email.required'     => 'El :attribute es obligatorio.',
            'email.email'        => 'El :attribute debe tener formato válido.',
            'code.required'      => 'El :attribute es obligatorio.',
            'code.digits'        => 'El :attribute debe tener exactamente :digits dígitos.',
            'password.required'  => 'La :attribute es obligatoria.',
            'password.string'    => 'La :attribute debe ser texto.',
            'password.max'       => 'La :attribute no puede exceder :max caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
    }

    /**
     * Atributos legibles en errores.
     */
    public function attributes(): array
    {
        return [
            'email'    => 'correo electrónico',
            'code'     => 'código de verificación',
            'password' => 'nueva contraseña',
        ];
    }
}
