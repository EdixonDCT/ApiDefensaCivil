<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateCityRequest
 * * Valida la actualización de una ciudad existente.
 * Incluye la lógica de exclusión para el nombre de la ciudad, permitiendo
 * actualizar otros campos sin que el nombre actual genere un conflicto de unicidad.
 */
class UpdateCityRequest extends FormRequest
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
         * Capturamos el ID de la ciudad desde la ruta para que la regla 'unique' 
         * lo ignore durante la validación de este registro.
         */
        $cityId = $this->route('city_id');

        return [
            'name'         => "required|string|max:50|unique:cities,name,{$cityId}",
            'department_id' => 'required|exists:departments,id'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin punto final.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'         => 'El :attribute es obligatorio',
            'name.string'           => 'El :attribute debe contener solo caracteres de texto',
            'name.max'              => 'El :attribute tiene un máximo de 50 caracteres',
            'name.unique'           => 'El :attribute ya se encuentra registrado',
            'department_id.required' => 'El :attribute es obligatorio',
            'department_id.exists'   => 'El :attribute seleccionado no existe'
        ];
    }

    /**
     * Define los nombres amigables de los campos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'         => 'nombre de la ciudad',
            'department_id' => 'departamento' 
        ];
    }
}