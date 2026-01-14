<?php

namespace App\Http\Requests\FamilyPlan;

use Illuminate\Foundation\Http\FormRequest;

class GeoreFamilyPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'georeference' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
    return [
        'last_names.required' => 'El campo :attribute es obligatorio.',
        'georeference.max' => 'El campo :attribute tiene maximo de 255 caracteres'
    ];
    }

    public function attributes(): array
    {
        return [
            'georeference' => 'Georreferenciacion'
        ];
    }
}
