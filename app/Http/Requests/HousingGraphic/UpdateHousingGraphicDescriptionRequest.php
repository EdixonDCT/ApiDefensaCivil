<?php

namespace App\Http\Requests\HousingGraphic;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateHousingGraphicDescriptionRequest
 * 
 * Valida únicamente la actualización de la descripción.
 */
class UpdateHousingGraphicDescriptionRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'description' => 'required|string|min:10|max:255',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'description.required' => 'La :attribute es obligatoria',
            'description.min'      => 'La :attribute debe tener al menos 10 caracteres',
            'description.max'      => 'La :attribute no debe superar los 255 caracteres',
        ];
    }

    /**
     * Nombre amigable del campo.
     */
    public function attributes(): array
    {
        return [
            'description' => 'descripción',
        ];
    }
}