<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
            'state_user_id' => 'required|exists:state_users,id',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico no debe exceder los 255 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'state.required' => 'El Estado de Usuario es obligatorio.',
            'state.exists' => 'El Estado de Usuario no existe en la base de datos.',
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'state_user_id' => 'ID del estado de usuario ',
    ];
    }
}
