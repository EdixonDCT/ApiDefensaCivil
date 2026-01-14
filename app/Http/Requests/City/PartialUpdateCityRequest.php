<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateCityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $city = $this->route('city_id');
        return [
            'name' => 'sometimes|string|max:50|unique:cities,name,'.$city,
            'sectional_id' => 'sometimes|exists:apartments,id',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'El nombre de la ciudad debe tener solo caracteres de tipo texto.',
            'name.max' => 'El nombre de la ciudad tiene maximo 50 caracteres.',
            'name.unique' => 'La ciudad ya existe.',
            'apartment_id.exists' => 'ID del apartamento no existe.',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre de la ciudad',
            'sectional_id' => 'ID del apartamento',
    ];
    }
}
