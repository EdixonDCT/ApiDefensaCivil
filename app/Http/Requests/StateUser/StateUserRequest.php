<?php

namespace App\Http\Requests\StateUser;

use Illuminate\Foundation\Http\FormRequest;

class StateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'state' => 'required|string|max:10|unique:state_users,state',
        ];
    }

    public function messages()
    {
        return [
            'state.required' => 'El Estado de Usuario es obligatorio.',
            'state.string' => 'El Estado de Usuario debe tener solo caracteres de tipo texto.',
            'state.unique' => 'El Estado de Usuario ya existe.',
            'state.max' => 'El Estado de Usuario tiene maximo 10 caracteres.'
        ];
    }
    public function attributes()
    {
        return [
            'state' => 'estado',
    ];
    }
}
