<?php

namespace App\Http\Requests\AvailableResource;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateAvailableResourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resource_id'     => 'sometimes|exists:resources,id',
            'location'        => 'sometimes|string|max:255',
            'distance'        => 'sometimes|string|max:50',
            'phone'           => 'sometimes|string|max:10',
            'description'     => 'sometimes|string|max:255',
            'family_plan_id'  => 'sometimes|exists:family_plans,id',
        ];
    }

    public function messages(): array
    {
        return [
            'resource_id.exists'   => 'El recurso seleccionado no existe.',
            'location.string'      => 'La ubicación debe ser texto.',
            'location.max'         => 'La ubicación no puede superar los 255 caracteres.',
            'distance.string'      => 'La distancia debe ser texto.',
            'distance.max'         => 'La distancia no puede superar los 50 caracteres.',
            'phone.string'         => 'El teléfono debe ser texto.',
            'phone.max'            => 'El teléfono no puede tener más de 10 caracteres.',
            'description.string'   => 'La descripción debe ser texto.',
            'description.max'      => 'La descripción no puede superar los 255 caracteres.',
            'family_plan_id.exists'=> 'El plan familiar seleccionado no existe.',
        ];
    }
}
