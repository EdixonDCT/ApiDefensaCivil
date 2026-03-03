<?php

namespace App\Http\Requests\HousingGraphic;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreHousingGraphicRequest
 * 
 * Valida la creación de gráficos de vivienda, incluyendo la carga de archivos.
 */
class StoreHousingGraphicRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación.
     */
    public function rules(): array
    {
        return [
            /**
             * Se asegura que el plan familiar exista y que no tenga ya un gráfico registrado.
             */
            'family_plan_id' => 'required|exists:family_plans,id|unique:housing_graphics,family_plan_id',

            /**
             * Descripción obligatoria entre 10 y 255 caracteres.
             */
            'description' => 'required|string|min:10|max:255',

            /**
             * Validación de imagen.
             */
            'path' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'family_plan_id.required' => 'El :attribute es obligatorio',
            'family_plan_id.exists'   => 'El :attribute seleccionado no es válido',
            'family_plan_id.unique'   => 'El :attribute ya cuenta con una imagen registrada',

            'description.required' => 'La :attribute es obligatoria',
            'description.min'      => 'La :attribute debe tener al menos 10 caracteres',
            'description.max'      => 'La :attribute no debe superar los 255 caracteres',

            'path.required' => 'La :attribute es obligatoria',
            'path.image'    => 'El archivo :attribute debe ser una imagen',
            'path.mimes'    => 'La :attribute debe ser en formato JPG, JPEG, PNG o WEBP',
            'path.max'      => 'La :attribute no debe pesar más de 2MB',
        ];
    }

    /**
     * Nombres amigables.
     */
    public function attributes(): array
    {
        return [
            'family_plan_id' => 'plan familiar',
            'description'    => 'descripción',
            'path'           => 'imagen del gráfico',
        ];
    }
}