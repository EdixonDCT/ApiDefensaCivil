<?php

namespace App\Http\Requests\Action;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreActionRequest
 * * Se encarga de validar los datos para el registro de nuevas acciones.
 * Utiliza el mapeo de atributos para generar mensajes de error dinámicos y limpios.
 */
class StoreActionRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para emitir esta solicitud.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación técnicas para los campos.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * El nombre debe ser único, máximo 50 caracteres y cumplir
             * con el formato de letras y espacios definido en AppServiceProvider.
             */
            'name' => 'required|alpha_spaces|string|max:50|unique:actions,name',
        ];
    }

    /**
     * Mensajes de error personalizados usando el comodín :attribute.
     * * Se han eliminado los puntos finales para una estética más limpia en el frontend.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'El :attribute es obligatorio',
            'name.alpha_spaces' => 'El :attribute debe contener únicamente letras y espacios',
            'name.string'       => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'       => 'El :attribute ya se encuentra registrado en el sistema',
            'name.max'          => 'El :attribute no puede superar los 50 caracteres'
        ];
    }

    /**
     * Define los nombres amigables de los campos que se inyectarán en :attribute.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre de la acción',
        ];
    }
}