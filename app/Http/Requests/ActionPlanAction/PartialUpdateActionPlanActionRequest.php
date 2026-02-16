<?php

namespace App\Http\Requests\ActionPlanAction;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateActionPlanActionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'action_type_id' => 'sometimes|exists:action_types,id',
            'description'    => 'sometimes|string|max:255',
            'member_id'      => 'sometimes|exists:members,id',
            'action_plan_id' => 'sometimes|exists:action_plans,id',
        ];
    }

    public function messages(): array
    {
        return [
            'action_type_id.exists' => 'El tipo de acción seleccionado no existe.',

            'description.string' => 'La descripción debe ser un texto.',
            'description.max'    => 'La descripción no puede superar los 255 caracteres.',

            'member_id.exists' => 'El integrante seleccionado no existe.',

            'action_plan_id.exists' => 'El plan de acción seleccionado no existe.',
        ];
    }
}
