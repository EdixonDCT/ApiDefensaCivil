<?php

namespace App\Http\Requests\ConditionType;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request para almacenar un nuevo Tipo de Condición.
 *
 * Se encarga de:
 * - Autorizar la petición
 * - Validar los datos de entrada
 * - Definir mensajes de error personalizados
 * - Definir nombres legibles para los atributos
 */
class StoreConditionTypeRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta petición.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // true = cualquier usuario puede ejecutar esta acción
        return true;
    }

    /**
     * Reglas de validación para crear un tipo de condición.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // El nombre es obligatorio, solo letras y espacios,
            // debe ser texto, máximo 50 caracteres
            // y único en la tabla condition_types
            'name' => 'required|alpha_spaces|string|max:50|unique:condition_types,name',
        ];
    }

    /**
     * Mensajes de error personalizados para las validaciones.
     *
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
     * Nombres personalizados para los atributos.
     *
     * Se usan en los mensajes de error ( :attribute ).
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre del tipo de condición',
        ];
    }
}
