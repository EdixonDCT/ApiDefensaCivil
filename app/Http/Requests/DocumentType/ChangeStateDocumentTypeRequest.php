<?php

namespace App\Http\Requests\DocumentType;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStateDocumentTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {   
        return [
            'is_active' => 'required|boolean|'
        ];
    }

    public function messages()
    {
        return [
            'is_active.required' => 'El estado activo del tipo de documento es obligatorio.',
            'is_active.boolean' => 'El estado activo del tipo de documento debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'is_active' => 'El estado activo del tipo de documento'
    ];
    }
}
