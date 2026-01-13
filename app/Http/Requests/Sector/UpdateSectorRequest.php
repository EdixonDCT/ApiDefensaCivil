<?php

namespace App\Http\Requests\Sector;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $sector = $this->route('sector_id');
        return [
            'name' => 'required|alpha|string|max:50|unique:sectors,name,'.$sector,
            'is_active' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del sector es obligatorio.',
            'name.alpha' => 'El nombre del sector debe tener solo letras.',
            'name.string' => 'El nombre del sector debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El nombre del sector ya existe.',
            'name.max' => 'El nombre del sector tiene maximo 50 caracteres.',
            'is_active.required' => 'El estado activo del sector es obligatorio.',
            'is_active.boolean' => 'El estado activo del sector debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre del sector',
            'is_active' => 'estado activo del sector'
    ];
    }
}
