<?php

namespace App\Http\Requests\HousingQuality;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHousingQualityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $housingQuality = $this->route('housingQuality_id');
        return [
            'name' => 'required|alpha|string|max:50|unique:housing_qualities,name,'.$housingQuality,
            'is_active' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la calidad de vivienda es obligatorio.',
            'name.alpha' => 'El nombre de la calidad de vivienda debe tener solo letras.',
            'name.string' => 'El nombre de la calidad de vivienda debe tener solo caracteres de tipo texto.',
            'name.unique' => 'La calidad de vivienda ya existe.',
            'name.max' => 'El nombre de la calidad de vivienda tiene maximo 50 caracteres.',
            'is_active.required' => 'El estado activo del genero es obligatorio.',
            'is_active.boolean' => 'El estado activo del genero debe tener activo o inactivo.'
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
