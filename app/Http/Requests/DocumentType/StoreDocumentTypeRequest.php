<?php

namespace App\Http\Requests\DocumentType;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreDocumentTypeRequest
 * * Valida los datos necesarios para registrar un nuevo tipo de documento (ej: Cédula, Pasaporte).
 * Obliga el uso de acrónimos en mayúsculas para mantener la estandarización en la base de datos.
 */
class StoreDocumentTypeRequest extends FormRequest
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
     * Define las reglas de validación para la creación del tipo de documento.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * El nombre debe ser único y seguir el formato de letras y espacios.
             */
            'name'    => 'required|alpha_spaces|string|max:50|unique:document_types,name',
            
            /**
             * El acrónimo es vital para búsquedas rápidas; debe ser alfabético y único.
             */
            'acronym' => 'required|alpha|uppercase|string|max:10|unique:document_types,acronym',
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            // Validación para el Nombre
            'name.required'     => 'El :attribute es obligatorio',
            'name.alpha_spaces' => 'El :attribute debe contener solo letras y espacios',
            'name.string'       => 'El :attribute debe ser una cadena de texto válida',
            'name.unique'       => 'El :attribute ya se encuentra registrado',
            'name.max'          => 'El :attribute no puede superar los 50 caracteres',
            
            // Validación para el Acrónimo
            'acronym.required'  => 'El :attribute es obligatorio',
            'acronym.alpha'     => 'El :attribute solo debe contener letras',
            'acronym.uppercase' => 'El :attribute debe estar escrito en mayúsculas',
            'acronym.string'    => 'El :attribute debe ser un texto válido',
            'acronym.unique'    => 'El :attribute ya existe en el sistema',
            'acronym.max'       => 'El :attribute no puede tener más de 10 caracteres'
        ];
    }

    /**
     * Define los nombres amigables de los campos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'    => 'nombre del tipo de documento',
            'acronym' => 'acrónimo del tipo de documento'
        ];
    }
}