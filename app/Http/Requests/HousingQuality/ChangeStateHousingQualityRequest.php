<?php

namespace App\Http\Requests\HousingQuality;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStateHousingQualityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'is_active' => 'required|boolean|'
        ];
    }

    public function messages()
    {
        return [
            'is_active.required' => 'El estado activo del genero es obligatorio.',
            'is_active.boolean' => 'El estado activo del genero debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'is_active' => 'estado activo de la calidad de vivienda'
    ];
    }
}
