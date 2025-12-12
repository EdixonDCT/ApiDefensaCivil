<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $User = $this->route('user_id');
        return [
            'email' => 'required|email|max:255|unique:users,email,'.$User,
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/',
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
            'password.regex' => 'La contraseña debe tener una mayuscula,una minuscula,un numero y un caracter especial.',
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
