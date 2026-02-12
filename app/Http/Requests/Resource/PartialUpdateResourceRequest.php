<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateResourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambiar a false si quieres controlar permisos
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'service' => 'sometimes|string|max:255',
            'active' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El nombre debe ser un texto.',
            'name.max' => 'El nombre no puede exceder 255 caracteres.',

            'service.string' => 'El servicio debe ser un texto.',
            'service.max' => 'El servicio no puede exceder 255 caracteres.',

            'active.boolean' => 'El valor de activo debe ser verdadero o falso.',
        ];
    }
}
