<?php

namespace App\Http\Requests\FamilyPlan;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusFamilyPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status_plan_id' => 'required|exists:status_plans,id',
        ];
    }

    public function messages(): array
    {
    return [
        'status_plan_id.required' => 'El campo :attribute es obligatorio',
        'status_plan_id.exists' => 'La :attribute seleccionado no es válido',
    ];
    }

    public function attributes(): array
    {
        return [
            'status_plan_id' => 'estado del plan'
        ];
    }
}
