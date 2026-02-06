<?php

namespace App\Http\Requests\Species;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreSpeciesRequest
 * Valida la creación inicial de una especie.
 */
class StoreSpeciesRequest extends FormRequest
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
            'name'   => 'required|string|max:50|unique:species,name',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El :attribute es obligatorio',
            'name.string'   => 'El :attribute debe ser una cadena de texto válida',
            'name.max'      => 'El :attribute no debe superar los :max caracteres',
            'name.unique'   => 'El :attribute ya se encuentra registrado',
        ];
    }

    /**
     * Nombres amigables.
     */
    public function attributes(): array
    {
        return [
            'name'   => 'nombre de la especie',
        ];
    }
}
