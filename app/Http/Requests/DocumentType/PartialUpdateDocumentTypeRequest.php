<?php

namespace App\Http\Requests\DocumentType;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PartialUpdateDocumentTypeRequest
 * * Gestiona la actualización parcial (PATCH) de los tipos de documentos.
 * Permite modificar campos de forma independiente asegurando la integridad 
 * de los nombres y acrónimos únicos.
 */
class PartialUpdateDocumentTypeRequest extends FormRequest
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
     * Define las reglas de validación.
     * @return array
     */
    public function rules(): array
    {
        /**
         * Capturamos el ID desde la ruta para las excepciones de unicidad.
         */
        $documentTypeId = $this->route('documentType_id');

        return [
            /**
             * 'sometimes' permite que el campo sea opcional en la petición.
             */
            'name'      => "sometimes|alpha_spaces|max:50|unique:document_types,name,{$documentTypeId}",
            
            /**
             * CORRECCIÓN: Se añadió la excepción de ID al acrónimo para evitar errores al editar.
             */
            'acronym'   => "sometimes|alpha|uppercase|string|max:10|unique:document_types,acronym,{$documentTypeId}",
            
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
            'name.alpha_spaces'  => 'El :attribute debe tener solo letras y espacios',
            'name.unique'        => 'El :attribute ya existe',
            'name.max'           => 'El :attribute tiene un máximo de 50 caracteres',
            
            'acronym.required'   => 'El :attribute es obligatorio',
            'acronym.alpha'      => 'El :attribute debe tener solo letras',
            'acronym.uppercase'  => 'El :attribute debe estar en mayúsculas',
            'acronym.string'     => 'El :attribute debe ser una cadena de texto',
            'acronym.unique'     => 'El :attribute ya existe',
            'acronym.max'        => 'El :attribute tiene un máximo de 10 caracteres',
            
            'is_active.boolean'  => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Atributos dinámicos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'      => 'nombre del tipo de documento',
            'acronym'   => 'acrónimo del tipo de documento',
            'is_active' => 'estado del tipo de documento'
        ];
    }
}