<?php

namespace App\Http\Requests\Sector;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|alpha|string|max:50|unique:sectors,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del sector es obligatorio.',
            'name.alpha' => 'El nombre del sector debe tener solo letras.',
            'name.string' => 'El nombre del sector debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El sector ya existe.',
            'name.max' => 'El nombre del sector tiene maximo 50 caracteres.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre del sector',
    ];
    }
}
