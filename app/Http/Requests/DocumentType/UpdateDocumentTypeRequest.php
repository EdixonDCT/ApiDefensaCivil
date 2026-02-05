<?php

namespace App\Http\Requests\DocumentType;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateDocumentTypeRequest
 * * Valida la actualización completa de un Tipo de Documento existente.
 * Gestiona excepciones de unicidad tanto para el nombre como para el acrónimo
 * utilizando el ID del registro actual capturado desde la ruta.
 */
class UpdateDocumentTypeRequest extends FormRequest
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
         * Capturamos el ID del tipo de documento desde la ruta de la petición.
         */
        $documentTypeId = $this->route('documentType_id');

        return [
            /**
             * El nombre ignora el ID actual para permitir guardar sin cambios.
             */
            'name'      => "required|alpha_spaces|string|max:50|unique:document_types,name,{$documentTypeId}",
            
            /**
             * CORRECCIÓN: Se añadió la excepción de ID al acrónimo para evitar conflictos de unicidad.
             */
            'acronym'   => "required|alpha|uppercase|string|max:10|unique:document_types,acronym,{$documentTypeId}",
            
            'is_active' => 'required|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados con :attribute y sin puntos finales.
     * @return array
     */
    public function messages(): array
    {
        return [
            // Validaciones del Nombre
            'name.required'      => 'El :attribute es obligatorio',
            'name.alpha_spaces'  => 'El :attribute debe tener solo letras y espacios',
            'name.string'        => 'El :attribute debe ser texto',
            'name.unique'        => 'El :attribute ya existe',
            'name.max'           => 'El :attribute tiene un máximo de 50 caracteres',

            // Validaciones del Acrónimo
            'acronym.required'   => 'El :attribute es obligatorio',
            'acronym.alpha'      => 'El :attribute debe tener solo letras',
            'acronym.uppercase'  => 'El :attribute debe estar en mayúsculas',
            'acronym.string'     => 'El :attribute debe ser texto',
            'acronym.unique'     => 'El :attribute ya existe',
            'acronym.max'        => 'El :attribute tiene un máximo de 10 caracteres',

            // Validaciones del Estado
            'is_active.required' => 'El :attribute es obligatorio',
            'is_active.boolean'  => 'El :attribute debe ser activo o inactivo'
        ];
    }

    /**
     * Atributos dinámicos para inyectar en los mensajes de error.
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