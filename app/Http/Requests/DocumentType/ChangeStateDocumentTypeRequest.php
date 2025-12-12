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
        $documentType = $this->route('documentType_id');
        return [
            'state' => 'required|boolean|'
        ];
    }

    public function messages()
    {
        return [
            'state.required' => 'El estado del tipo de documento es obligatorio.',
            'state.boolean' => 'El estado del tipo de documento debe tener activo o inactivo.'
        ];
    }
    public function attributes()
    {
        return [
            'state' => 'estado del tipo de documento'
    ];
    }
}
