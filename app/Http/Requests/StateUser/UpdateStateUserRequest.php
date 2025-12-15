<?php

namespace App\Http\Requests\StateUser;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $stateUser = $this->route('state_user_id');
        return [
            'name' => 'required|alpha|string|max:50|unique:state_users,name,'.$stateUser,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del estado de usuario es obligatorio.',
            'name.alpha' => 'El nombre del estado de usuario debe tener solo letras.',
            'name.string' => 'El nombre del estado de usuario debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El nombre del estado de usuario ya existe.',
            'name.max' => 'El nombre del estado de usuario tiene maximo 50 caracteres.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre del estado de usuario',
    ];
    }
}
