<?php


namespace App\Http\Requests\Account;


use Illuminate\Foundation\Http\FormRequest;


/**
 * Valida los datos para verificar la contraseña antes de una acción sensible.
 *
 * Se usa en: POST /account/verify-password
 *
 * El campo 'action' determina para qué operación se generará
 * el token temporal. Debe coincidir con el parámetro del middleware
 * password.verify:{action} en la ruta protegida correspondiente.
 *
 * Acciones disponibles:
 * - change_email    → cambio de correo electrónico
 * - change_phone    → cambio de teléfono (futuro)
 * - change_document → cambio de documento (futuro)
 */
class VerifyPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'password' => [
                'required',                                         // Campo obligatorio
                'string',                                           // Debe ser texto
            ],
            'action' => [
                'required',                                         // Campo obligatorio
                'string',                                           // Debe ser texto
                'in:change_email,change_phone,change_document',    // Solo acciones permitidas
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'password.required' => 'La contraseña es obligatoria.',
            'password.string'   => 'La contraseña debe ser un texto válido.',
            'action.required'   => 'La acción es obligatoria.',
            'action.string'     => 'La acción debe ser un texto válido.',
            'action.in'         => 'La acción solicitada no es válida.',
        ];
    }


    public function attributes(): array
    {
        return [
            'password' => 'contraseña',
            'action'   => 'acción',
        ];
    }
}
