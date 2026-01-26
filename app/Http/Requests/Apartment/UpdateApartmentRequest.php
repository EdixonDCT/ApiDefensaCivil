<?php

namespace App\Http\Requests\Apartment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateApartmentRequest
 * * Se encarga de validar la edición de apartamentos existentes.
 * Gestiona la excepción de unicidad para permitir que el registro mantenga su nombre 
 * original sin generar conflictos durante la actualización.
 */
class UpdateApartmentRequest extends FormRequest
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
     * Define las reglas de validación para la actualización de un apartamento.
     * @return array
     */
    public function rules(): array
    {
        /**
         * Obtenemos el ID de la ruta para la excepción en la regla 'unique'.
         * Esto evita que falle la validación si no se cambia el nombre.
         */
        $apartmentId = $this->route('apartment_id');

        return [
            'name' => "required|alpha_spaces|string|max:50|unique:apartments,name,{$apartmentId}",
        ];
    }

    /**
     * Mensajes de error personalizados.
     * * Se usa :attribute para dinamismo y se eliminan los puntos finales.
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
     * Define el nombre amigable del campo para los mensajes.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'nombre del apartamento',
        ];
    }
}