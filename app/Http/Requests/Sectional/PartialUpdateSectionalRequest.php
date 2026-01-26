<?php

namespace App\Http\Requests\Sectional;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateSectionalRequest
 * * Permite actualizaciones parciales (PATCH) de las seccionales.
 * Valida el nombre con soporte para espacios y maneja la excepción de unicidad por ID.
 */
class PartialUpdateSectionalRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para la actualización parcial.
     * @return array
     */
    public function rules(): array
    {
        $sectionalId = $this->route('sectional_id');

        return [
            /**
             * 'sometimes' asegura que solo se valide si el campo está presente.
             * 'alpha_spaces' es una regla personalizada ideal para nombres de ciudades o sedes.
             */
            'name'      => "sometimes|alpha_spaces|string|max:50|unique:sectionals,name,{$sectionalId}",
            'is_active' => 'sometimes|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.alpha_spaces' => 'El :attribute debe contener solo letras y espacios',
            'name.string'       => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'       => 'La :attribute ya se encuentra registrada',
            'name.max'          => 'El :attribute no debe superar los :max caracteres',
            'is_active.boolean' => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'      => 'nombre de la seccional',
            'is_active' => 'estado de la seccional'
        ];
    }
}