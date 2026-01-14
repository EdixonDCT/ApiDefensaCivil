<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:cities,name',
            'apartment_id' => 'required|exists:apartments,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la ciudad es obligatorio.',
            'name.string' => 'El nombre de la ciudad debe tener solo caracteres de tipo texto.',
            'name.max' => 'El nombre de la ciudad tiene maximo 50 caracteres.',
            'name.unique' => 'La ciudad ya existe.',
            'apartment_id.required' => 'ID del apartamento es obligatorio.',
            'apartment_id.exists' => 'ID del apartamento no existe.',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre de la organizacion',
            'apartment_id' => 'ID del apartamento'
    ];
    }
}
