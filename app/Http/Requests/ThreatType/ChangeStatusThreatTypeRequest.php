<?php

namespace App\Http\Requests\ThreatType;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusThreatTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ajusta si necesitas permisos específicos
    }

    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean', // obligatorio para changeState
        ];
    }

    public function messages(): array
    {
        return [
            'is_active.required' => 'El estado es obligatorio.',
            'is_active.boolean'  => 'El estado debe ser verdadero o falso.',
        ];
    }
}
