<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|password_security',
            'state_user_id' => 'required|exists:state_users,id',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico no debe exceder los 255 caracteres.',
            'email.unique' => 'El correo electrónico ya esta registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.password_security' => 'La contraseña debe tener una mayuscula,una minuscula,un numero y un caracter especial.',
            'state_user_id.required' => 'El Estado de Usuario es obligatorio.',
            'state_user_id.exists' => 'El Estado de Usuario no existe en la base de datos.',
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
