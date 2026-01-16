<?php

namespace App\Http\Requests\HousingInfo;

use Illuminate\Foundation\Http\FormRequest;

class StoreHousingInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'family_plan_id' => 'required|exists:family_plans,id|unique:housing_infos,family_plan_id',
            'path' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'family_plan_id.required' => 'El :attribute es obligatorio.',
            'family_plan_id.exists' => 'El :attribute seleccionado no es válido.',
            'family_plan_id.unique' => 'El :attribute solo puede tener una imagen.',
            'path.required' => 'La :attribute es obligatoria.',
            'path.image' => 'El archivo :attribute debe ser una imagen.',
            'path.mimes' => 'La :attribute debe ser JPG, JPEG, PNG o WEBP.',
            'path.max' => 'La :attribute no debe pesar más de 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'family_plan_id' => 'plan familiar',
            'path' => 'imagen',
        ];
    }
}
