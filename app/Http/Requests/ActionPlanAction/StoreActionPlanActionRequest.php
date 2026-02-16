<?php

namespace App\Http\Requests\ActionPlanAction;

use Illuminate\Foundation\Http\FormRequest;

class StoreActionPlanActionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'action_type_id' => 'required|exists:action_types,id',
            'description'    => 'required|string|max:255',
            'member_id'      => 'required|exists:members,id',
            'action_plan_id' => 'required|exists:action_plans,id',
        ];
    }

    public function messages(): array
    {
        return [
            'action_type_id.required' => 'El tipo de acción es obligatorio.',
            'action_type_id.exists'   => 'El tipo de acción seleccionado no existe.',

            'description.required' => 'La descripción es obligatoria.',
            'description.string'   => 'La descripción debe ser un texto.',
            'description.max'      => 'La descripción no puede superar los 255 caracteres.',

            'member_id.required' => 'El integrante es obligatorio.',
            'member_id.exists'   => 'El integrante seleccionado no existe.',

            'action_plan_id.required' => 'El plan de acción es obligatorio.',
            'action_plan_id.exists'   => 'El plan de acción seleccionado no existe.',
        ];
    }
}
