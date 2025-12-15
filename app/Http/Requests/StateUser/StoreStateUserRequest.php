<?php

namespace App\Http\Requests\StateUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreStateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'state' => 'required|alpha|string|max:50|unique:state_users,state',
        ];
    }

    public function messages()
    {
        return [
            'state.required' => 'El Estado de Usuario es obligatorio.',
            'state.alpha' => 'El Estado de Usuario debe tener solo letras.',
            'state.string' => 'El Estado de Usuario debe tener solo caracteres de tipo texto.',
            'state.unique' => 'El Estado de Usuario ya existe.',
            'state.max' => 'El Estado de Usuario tiene maximo 50 caracteres.'
        ];
    }
    public function attributes()
    {
        return [
            'state' => 'estado',
    ];
    }
}
