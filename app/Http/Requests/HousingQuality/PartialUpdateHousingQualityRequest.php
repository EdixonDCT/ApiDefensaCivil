<?php

namespace App\Http\Requests\HousingQuality;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateHousingQualityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $housingQuality = $this->route('housingQuality_id');
        return [
            'name' => 'sometimes|alpha|string|max:50|unique:housing_qualities,name,'.$housingQuality,
            'is_active' => 'sometimes|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.alpha' => 'El nombre de la calidad de vivienda debe tener solo letras.',
            'name.string' => 'El nombre de la calidad de vivienda debe tener solo caracteres de tipo texto.',
            'name.unique' => 'La calidad de vivienda ya existe.',
            'name.max' => 'El nombre de la calidad de vivienda tiene maximo 50 caracteres.',
            'is_active.boolean' => 'El estado activo de la calidad de vivienda debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre de la calidad de vivienda',
            'is_active' => 'estado activo de la calidad de vivienda'
    ];
    }
}
