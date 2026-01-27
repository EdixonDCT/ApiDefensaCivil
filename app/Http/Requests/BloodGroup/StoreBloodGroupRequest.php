<?php

namespace App\Http\Requests\BloodGroup;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreBloodGroupRequest
 * Se encarga de validar la creación de un nuevo registro de grupo sanguíneo.
 * Asegura que el valor cumpla con el formato permitido (A+, O-, AB+, etc.).
 */
class StoreBloodGroupRequest extends FormRequest
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
     * Define las reglas de validación para el grupo sang   uíneo.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * El nombre es obligatorio, debe cumplir la regla bloodValue,
             * tener máximo 3 caracteres y ser único en la tabla blood_groups.
             */
            'name' => 'required|string|max:3|blood_value|unique:blood_groups,name',
        ];
    }

    /**
     * Mensajes de error personalizados usando :attribute y sin punto final.
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required'   => 'El :attribute es obligatorio',
            'name.string'     => 'El :attribute debe ser una cadena de texto válida',
            'name.max'        => 'El :attribute no puede tener más de 3 caracteres',
            'name.blood_value' => 'El :attribute debe contener una letra mayuscula,minimo 2 caracteres y un signo + o - en la parte derecha',
            'name.unique'     => 'El :attribute ya se encuentra registrado',
        ];
    }

    /**
     * Define el nombre amigable del atributo para los mensajes.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'grupo sanguíneo',
        ];
    }
}
