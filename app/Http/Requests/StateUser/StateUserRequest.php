<?php

namespace App\Http\Requests\StateUser;

use Illuminate\Foundation\Http\FormRequest;

class stateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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
