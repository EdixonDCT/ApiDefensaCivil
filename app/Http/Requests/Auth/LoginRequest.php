<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El :attribute es obligatorio.',
            'email.email' => 'El :attribute no tiene el formato correcto.',
            'password.required'=>'La :attribute es obligatoria.',
        ];

    }

    public function attributes(): array
    {
        return [
            'email' => 'correo electronico',
            'password' => 'contraseña'
        ];
    }
}