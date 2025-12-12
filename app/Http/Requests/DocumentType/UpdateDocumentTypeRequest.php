<?php

namespace App\Http\Requests\DocumentType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $documentType = $this->route('documentType_id');
        return [
            'state' => 'required|boolean|'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del tipo de documento es obligatorio.',
            'name.string' => 'El nombre del tipo de documento debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El tipo de documento ya existe.',
            'name.max' => 'El nombre del tipo de documento tiene maximo 50 caracteres.',
            'state.required' => 'El estado del tipo de documento es obligatorio.',
            'state.boolean' => 'El estado del tipo de documento debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre del tipo de documento',
            'state' => 'estado del tipo de documento'
    ];
    }
}
