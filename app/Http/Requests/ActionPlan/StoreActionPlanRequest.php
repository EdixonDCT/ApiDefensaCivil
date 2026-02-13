<?php

namespace App\Http\Requests\ActionPlan;

use Illuminate\Foundation\Http\FormRequest;

class StoreActionPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'action_type_id' => 'required|exists:action_types,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'action_type_id.required' => 'El tipo de acción es obligatorio',
            'action_type_id.exists' => 'El tipo de acción no existe'
        ];
    }
}
