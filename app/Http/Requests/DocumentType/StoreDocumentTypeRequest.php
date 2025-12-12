<?php

namespace App\Http\Requests\DocumentType;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:document_types,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del tipo de documento es obligatorio.',
            'name.string' => 'El nombre del tipo de documento debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El tipo de documento ya existe.',
            'name.max' => 'El nombre del tipo de documento tiene maximo 50 caracteres.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre del tipo de documento',
    ];
    }
}
