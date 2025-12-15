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
            'name' => 'required|alpha_spaces|string|max:50|unique:document_types,name,'.$documentType,
            'acronym' => 'required|alpha|uppercase|string|max:10|unique:document_types,acronym',
            'is_active' => 'required|boolean|'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del tipo de documento es obligatorio.',
            'name.alpha_spaces' => 'El nombre del tipo de documento debe tener solo letras y espacios.',
            'name.string' => 'El nombre del tipo de documento debe tener solo caracteres de tipo texto.',
            'name.unique' => 'El tipo de documento ya existe.',
            'name.max' => 'El nombre del tipo de documento tiene maximo 50 caracteres.',
            'acronym.required' => 'El acronimo del tipo de documento es obligatorio.',
            'acronym.alpha' => 'El acronimo del tipo de documento debe tener solo letras.',
            'acronym.uppercase' => 'El acronimo del tipo de documento debe estar en mayusculas.',
            'acronym.string' => 'El acronimo del tipo de documento debe tener solo caracteres de tipo texto.',
            'acronym.unique' => 'El acronimo del tipo de documento ya existe.',
            'acronym.max' => 'El acronimo del tipo de documento tiene maximo 10 caracteres.',
            'is_active.required' => 'El estado activo del tipo de documento es obligatorio.',
            'is_active.boolean' => 'El estado activo del tipo de documento debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'nombre del tipo de documento',
            'acronym' => 'acronimo del tipo de documento',
            'is_active' => 'El estado activo del tipo de documento'
    ];
    }
}
