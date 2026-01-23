<?php

namespace App\Http\Requests\FamilyPlan;

use Illuminate\Foundation\Http\FormRequest;

class IdentifyFamilyPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_names' => 'required|alpha_spaces|string|max:255',
            'address' => 'required|string|max:255',
            'sector_id' => 'required|exists:sectors,id',
            'sector_name' => 'required|alpha_spaces|max:50',
            'landline_phone' => 'sometimes|nullable|numeric|min_digits:7|max_digits:10',
            'housing_quality_id' => 'required|exists:housing_qualities,id',
        ];
    }

    public function messages(): array
    {
    return [
        'last_names.required' => 'El campo :attribute es obligatorio.',
        'last_names.alpha_spaces' => 'El campo :attribute solo puede contener letras y espacios.',
        'last_names.string' => 'El campo :attribute debe ser un texto.',
        'last_names.max' => 'El campo :attribute no puede tener más de 255 caracteres.',
        'address.required' => 'El campo :attribute es obligatorio.',
        'address.max' => 'El campo :attribute no puede tener más de 255 caracteres.',
        'sector_id.required' => 'Debe seleccionar un :attribute.',
        'sector_id.exists' => 'El :attribute seleccionado no es válido.',
        'sector_name.required' => 'El campo :attribute es obligatorio.',
        'sector_name.alpha_spaces' => 'El campo :attribute debe ser un texto y espacios.',
        'sector_name.max' => 'El campo :attribute no puede tener más de 50 caracteres.',
        'landline_phone.numeric' => 'El campo :attribute solo debe contener números.',
        'landline_phone.min_digits' => 'El campo :attribute debe tener al menos 7 dígitos.',
        'landline_phone.max_digits' => 'El campo :attribute no puede tener más de 10 dígitos.',
        'housing_quality_id.required' => 'Debe seleccionar una :attribute.',
        'housing_quality_id.exists' => 'La :attribute seleccionada no es válida.',
    ];
    }

    public function attributes(): array
    {
        return [
            'last_names' => 'apellidos',
            'zone_id' => 'zona',
            'city_id' => 'ciudad',
            'sectionals_id' => 'seccional',
            'address' => 'dirección',
            'sector_id' => 'sector',
            'sector_name' => 'nombre del sector',
            'landline_phone' => 'teléfono fijo',
            'housing_quality_id' => 'calidad de vivienda',
        ];
    }
}
