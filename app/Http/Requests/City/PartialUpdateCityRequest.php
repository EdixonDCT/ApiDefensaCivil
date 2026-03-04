<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateCityRequest
 * * Se utiliza para actualizaciones parciales (PATCH). 
 * La regla 'sometimes' permite que los campos sean opcionales, validándolos 
 * solo si están presentes en la solicitud.
 */
class PartialUpdateCityRequest extends FormRequest
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
        $cityId = $this->route('city_id');

        return [
            /**
             * 'sometimes' asegura que si no envías el nombre, no falle, 
             * pero si lo envías, debe ser único (ignorando el registro actual).
             */
            'name' => "sometimes|string|max:50|unique:cities,name,{$cityId}",

            'department_id' => 'sometimes|exists:departments,id',
        ];
    }

    /**
     * Mensajes de error personalizados usando :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.string'         => 'El :attribute debe contener solo caracteres de texto',
            'name.max'            => 'El :attribute no puede superar los 50 caracteres',
            'name.unique'         => 'El :attribute ya se encuentra registrado',
            'department_id.exists' => 'Rl :attribute seleccionado no existe en el sistema'
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
            'department_id' => 'departamento',
        ];
    }
}