<?php

namespace App\Http\Requests\Species;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateSpeciesRequest
 * Valida la actualización completa de una especie.
 */
class UpdateSpeciesRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
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
        $speciesId = $this->route('id');

        return [
            'name'   => "required|string|max:50|unique:species,name,{$speciesId}",
            'active' => 'required|boolean',
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

            'active.required' => 'El :attribute es obligatorio',
            'active.boolean'  => 'El :attribute debe ser verdadero o falso',
        ];
    }

    /**
     * Nombres amigables de atributos.
     */
    public function attributes(): array
    {
        return [
            'name'   => 'nombre de la especie',
            'active' => 'estado',
        ];
    }
}
