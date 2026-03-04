<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreCityRequest
 * * Valida la creación de una nueva ciudad en el sistema.
 * Asegura que la ciudad esté vinculada a un apartamento/bloque válido
 * y que el nombre no se repita para mantener la integridad territorial.
 */
class StoreCityRequest extends FormRequest
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
     * Define las reglas de validación para el registro de una ciudad.
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:50|unique:cities,name',
            'department_id' => 'required|exists:departments,id',
        ];
    }

    /**
     * Mensajes de error personalizados usando :attribute.
     * * Se han eliminado los puntos finales para una visualización más limpia.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'         => 'El :attribute es obligatorio',
            'name.string'           => 'El :attribute debe contener solo caracteres de texto',
            'name.max'              => 'El :attribute no puede superar los 50 caracteres',
            'name.unique'           => 'El :attribute ya se encuentra registrado',
            'department_id.required' => 'El :attribute es obligatorio',
            'department_id.exists'   => 'El :attribute seleccionado no es válido'
        ];
    }

    /**
     * Define los nombres amigables de los atributos.
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