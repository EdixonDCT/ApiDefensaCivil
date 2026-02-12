<?php

namespace App\Http\Requests\ThreatType;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateThreatTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Obtener el ID desde la ruta
        $threatTypeId = $this->route('threatType_id');

        return [
            'name' => "sometimes|string|max:255|unique:threat_types,name,{$threatTypeId}",
            'is_active' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El nombre debe ser un texto válido.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'name.unique' => 'Este nombre ya está registrado.',

            'is_active.boolean' => 'El estado debe ser verdadero o falso.',
        ];
    }
}
