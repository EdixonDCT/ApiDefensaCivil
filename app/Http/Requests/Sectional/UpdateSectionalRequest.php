<?php

namespace App\Http\Requests\Sectional;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateSectionalRequest
 * * Valida la actualización completa de una seccional existente.
 * Mantiene la regla alpha_spaces y asegura que el estado sea booleano.
 */
class UpdateSectionalRequest extends FormRequest
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
     * Define las reglas de validación para la actualización.
     * @return array
     */
    public function rules(): array
    {
        /**
         * Obtenemos el ID de la seccional para ignorarlo en la validación unique.
         */
        $sectionalId = $this->route('sectional_id');

        return [
            'name'      => "required|alpha_spaces|string|max:50|unique:sectionals,name,{$sectionalId}",
            'is_active' => 'required|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y placeholders dinámicos.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'      => 'El :attribute es obligatorio',
            'name.alpha_spaces'  => 'El :attribute debe contener solo letras y espacios',
            'name.string'        => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'        => 'La :attribute ya se encuentra registrada',
            'name.max'           => 'El :attribute no debe superar los :max caracteres',
            
            'is_active.required' => 'El :attribute es obligatorio',
            'is_active.boolean'  => 'El :attribute debe ser activo o inactivo'
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