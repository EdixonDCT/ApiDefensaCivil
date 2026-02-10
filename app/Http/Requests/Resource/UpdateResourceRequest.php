<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Cambiar a false si quieres controlar permisos
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'active' => 'required|boolean',
        ];
    }

    /**
     * Custom messages for validation errors
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El nombre debe ser un texto.',
            'name.max' => 'El nombre no puede exceder 255 caracteres.',

            'service.required' => 'El campo servicio es obligatorio.',
            'service.string' => 'El servicio debe ser un texto.',
            'service.max' => 'El servicio no puede exceder 255 caracteres.',

            'active.required' => 'El campo activo es obligatorio.',
            'active.boolean' => 'El valor de activo debe ser verdadero o falso.',
        ];
    }
}
