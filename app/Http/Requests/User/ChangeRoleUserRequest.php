<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRoleUserRequest extends FormRequest
{
    /**
     * Determina si el usuario puede hacer esta acción.
     */
    public function authorize(): bool
    {
        return true; // aquí puedes meter lógica de permisos si quieres
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'role' => 'required', 'string', 'exists:roles,name'
        ];
    }

    /**
     * Mensajes personalizados (opcional pero recomendado).
     */
    public function messages(): array
    {
        return [
            'role.required' => 'El rol es obligatorio.',
            'role.string'   => 'El rol debe ser un texto válido.',
            'role.exists'   => 'El rol seleccionado no existe.',
        ];
    }
}