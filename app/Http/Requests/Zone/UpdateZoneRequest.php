<?php

namespace App\Http\Requests\Zone;

use Illuminate\Foundation\Http\FormRequest;

class UpdateZoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $zone = $this->route('zone_id');
        return [
            'name' => 'required|alpha|string|max:50|unique:zones,name,'.$zone,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del tipo de zona es obligatorio.',
            'name.alpha' => 'El nombre del tipo de zona debe tener solo letras.',
            'name.string' => 'El nombre del tipo de zona debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El tipo de zona ya existe.',
            'name.max' => 'El nombre del tipo de zona tiene maximo 50 caracteres.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'tipo de zona',
    ];
    }
}
