<?php

namespace App\Http\Requests\DocumentType;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChangeStateDocumentTypeRequest
 * * Se encarga de validar el cambio de estado (activación/desactivación) 
 * de un tipo de documento específico.
 */
class ChangeStateDocumentTypeRequest extends FormRequest
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
     * Define las reglas de validación para el cambio de estado.
     * @return array
     */
    public function rules(): array
    {   
        return [
            /**
             * is_active debe ser obligatoriamente un valor booleano (true/false, 1/0).
             */
            'is_active' => 'required|boolean'
        ];
    }

    /**
     * Mensajes de error personalizados usando :attribute y sin punto final.
     * @return array
     */
    public function messages(): array
    {
        return [
            'is_active.required' => 'El :attribute es obligatorio',
            'is_active.boolean'  => 'El :attribute debe ser activado o desactivado'
        ];
    }

    /**
     * Define el nombre amigable del atributo.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'is_active' => 'estado del tipo de documento'
        ];
    }
}