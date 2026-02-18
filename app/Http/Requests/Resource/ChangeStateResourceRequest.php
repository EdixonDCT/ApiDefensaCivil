<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStateResourceRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return true; // Ajusta según tus permisos si lo necesitas
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean', // Obligatorio para changeState
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'is_active.required' => 'El estado del recurso es obligatorio.',
            'is_active.boolean'  => 'El estado debe ser verdadero o falso.',
        ];
    }

    /**
     * Nombres amigables de los atributos.
     */
    public function attributes(): array
    {
        return [
            'is_active' => 'estado del recurso',
        ];
    }
}
