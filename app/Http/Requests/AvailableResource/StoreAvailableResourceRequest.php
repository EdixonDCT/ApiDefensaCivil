<?php

namespace App\Http\Requests\AvailableResource;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvailableResourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resource_id' => 'required|exists:resources,id',
            'location' => 'required|string|max:255',
            'distance' => 'required|integer|min:1|max:5000',
            'phone' => 'required|string|max:10',
            'description' => 'required|string|max:255',
            'family_plan_id' => 'required|exists:family_plans,id',
        ];
    }

    public function messages(): array
    {
        return [
            'resource_id.required' => 'El recurso es obligatorio.',
            'resource_id.exists'   => 'El recurso seleccionado no existe.',

            'location.required' => 'La ubicación es obligatoria.',
            'location.string'   => 'La ubicación debe ser texto.',
            'location.max'      => 'La ubicación no puede superar los 255 caracteres.',

            'distance.required' => 'La distancia es obligatoria.',
            'distance.integer' => 'La distancia debe ser un número entero.',
            'distance.min' => 'La distancia debe ser mayor o igual a 1 metro.',
            'distance.max' => 'La distancia no puede superar los 5000 metros.',

            'phone.required' => 'El teléfono es obligatorio.',
            'phone.string'   => 'El teléfono debe ser texto.',
            'phone.max'      => 'El teléfono no puede tener más de 10 caracteres.',

            'description.required' => 'La descripción es obligatoria.',
            'description.string'   => 'La descripción debe ser texto.',
            'description.max'      => 'La descripción no puede superar los 255 caracteres.',

            'family_plan_id.required' => 'El plan familiar es obligatorio.',
            'family_plan_id.exists'   => 'El plan familiar seleccionado no existe.',
        ];
    }
}
