<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreApartmentRequest
 * * Se encarga de validar los datos para el registro de nuevos departamentos.
 * Utiliza la regla personalizada 'alpha_spaces' para garantizar la limpieza de los nombres.
 */
class StoreDepartmentRequest extends FormRequest
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
     * Define las reglas de validación para la creación de un departamento.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * El nombre es obligatorio, debe cumplir con el formato de letras y espacios,
             * ser texto, no exceder 50 caracteres y ser único en la tabla 'departments'.
             */
            'name' => 'required|alpha_spaces|string|max:50|unique:departments,name',
        ];
    }

    /**
     * Mensajes de error personalizados.
     * * Se usa :attribute para dinamismo y se eliminan los puntos finales por estética.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'El :attribute es obligatorio',
            'name.alpha_spaces' => 'El :attribute debe tener solo letras y espacios',
            'name.string'       => 'El :attribute debe ser de tipo texto',
            'name.unique'       => 'El :attribute ya existe',
            'name.max'          => 'El :attribute tiene un máximo de 50 caracteres'
        ];
    }

    /**
     * Define el nombre amigable del campo para ser inyectado en los mensajes.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre del departamento',
        ];
    }
}