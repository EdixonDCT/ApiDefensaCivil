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

            // Comentario opcional pero más amplio (ideal para TEXT)
            'comentary' => 'nullable|string|max:2000',
        ];
    }

    public function messages(): array
    {
        return [
            'status_plan_id.required' => 'El :attribute es obligatorio',
            'status_plan_id.exists'   => 'El :attribute seleccionado no es válido',

            'comentary.string' => 'El comentario debe ser texto válido',
            'comentary.max'    => 'El comentario no puede superar los :max caracteres'
        ];
    }

    public function attributes(): array
    {
        return [
            'status_plan_id' => 'estado del plan',
            'comentary'      => 'comentario'
        ];
    }
}