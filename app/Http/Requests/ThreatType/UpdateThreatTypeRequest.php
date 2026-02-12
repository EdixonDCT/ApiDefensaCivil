<?php

namespace App\Http\Requests\ThreatType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThreatTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Tomamos el ID desde la ruta
        $threatTypeId = $this->route('threatType_id');

        return [
            'name' => "required|string|max:255|unique:threat_types,name,{$threatTypeId}",
            'is_active' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del tipo de amenaza es obligatorio.',
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'name.unique' => 'Este nombre ya está registrado.',

            'is_active.required' => 'El estado es obligatorio.',
            'is_active.boolean' => 'El estado debe ser verdadero o falso.',
        ];
    }
}
