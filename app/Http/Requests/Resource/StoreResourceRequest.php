<?php

namespace App\Http\Requests\Resource;

use Illuminate\Foundation\Http\FormRequest;

class StoreResourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255|unique:resources,name',
            'service' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string'   => 'El nombre debe ser un texto.',
            'name.max'      => 'El nombre no puede exceder 255 caracteres.',
            'name.unique'   => 'Ya existe un recurso con ese nombre.',

            'service.required' => 'El campo servicio es obligatorio.',
            'service.string'   => 'El servicio debe ser un texto.',
            'service.max'      => 'El servicio no puede exceder 255 caracteres.',
        ];
    }
}
