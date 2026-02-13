<?php

namespace App\Http\Requests\ActionPlan;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateActionPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'action_type_id' => 'sometimes|exists:action_types,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'El nombre debe ser un texto válido',
            'name.max' => 'El nombre no puede superar los 255 caracteres',

            'description.string' => 'La descripción debe ser un texto válido',

            'action_type_id.exists' => 'El tipo de acción no existe'
        ];
    }
}
