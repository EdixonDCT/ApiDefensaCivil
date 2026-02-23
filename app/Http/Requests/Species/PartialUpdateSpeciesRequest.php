<?php

namespace App\Http\Requests\Species;

use Illuminate\Foundation\Http\FormRequest;

class PartialUpdateSpeciesRequest extends FormRequest
{
    /**
     * Autorizar la solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualización parcial.
     */
    public function rules(): array
    {
        $speciesId = $this->route('specie_id');

        return [
            'name'   => "sometimes|string|max:50|unique:species,name,{$speciesId}",
            'is_active' => 'sometimes|boolean',
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'name.string'  => 'El :attribute debe ser una cadena de texto válida',
            'name.max'     => 'El :attribute no debe superar los :max caracteres',
            'name.unique'  => 'El :attribute ya se encuentra registrado',

            'is_active.boolean' => 'El :attribute debe ser verdadero o falso',
        ];
    }

    /**
     * Nombres amigables.
     */
    public function attributes(): array
    {
        return [
            'name'   => 'nombre de la especie',
            'is_active' => 'estado de la especie',
        ];
    }
}
    