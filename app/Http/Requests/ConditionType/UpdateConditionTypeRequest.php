<?php

namespace App\Http\Requests\ConditionType;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request para actualizar un Tipo de Condición.
 *
 * Se encarga de:
 * - Autorizar la petición
 * - Validar los datos al actualizar
 * - Definir mensajes de error personalizados
 * - Definir nombres legibles para los atributos
 */
class UpdateConditionTypeRequest extends FormRequest
{
    /**
     * Autoriza la ejecución de la petición.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Permite la actualización (ajusta si luego manejas permisos)
        return true;
    }

    /**
     * Reglas de validación para actualizar un tipo de condición.
     *
     * @return array
     */
    public function rules(): array
    {
        // Obtiene el ID del tipo de condición desde la ruta
        // Ej: /condition-types/{condition_type}
        $conditionTypeId = $this->route('condition_type');

        return [
            // El nombre es obligatorio, solo letras y espacios,
            // máximo 50 caracteres y debe ser único,
            // ignorando el registro que se está actualizando
            'name' => 'required|alpha_spaces|string|max:50|unique:condition_types,name,' . $conditionTypeId,
        ];
    }

    /**
     * Mensajes de error personalizados.
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
     * Nombres personalizados de los atributos.
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
