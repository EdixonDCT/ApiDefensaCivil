<?php


namespace App\Http\Requests\Account;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


/**
 * Valida los datos para actualizar el correo electrónico del usuario.
 *
 * Se usa en: PATCH /account/email
 * Middleware previo requerido: password.verify:change_email
 *
 * El correo debe ser único en la tabla users, ignorando
 * el registro del usuario autenticado para evitar falso positivo
 * cuando el usuario envía su mismo correo actual.
 */
class UpdateEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'email' => [
                'required',                                          // Campo obligatorio
                'string',                                           // Debe ser texto
                'email',                                            // Formato válido de correo
                'max:255',                                          // Límite de caracteres
                Rule::unique('users', 'email')                     // Único en la tabla users
                    ->ignore($this->user()->id),                   // Ignora el usuario actual
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.string'   => 'El correo debe ser un texto válido.',
            'email.email'    => 'El correo electrónico no tiene un formato válido.',
            'email.max'      => 'El correo no debe superar los 255 caracteres.',
            'email.unique'   => 'Este correo electrónico ya está en uso.',
        ];
    }


    public function attributes(): array
    {
        return [
            'email' => 'correo electrónico',
        ];
    }
}
