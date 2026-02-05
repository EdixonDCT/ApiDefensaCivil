<?php

namespace App\Http\Requests\BloodGroup;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateBloodGroupRequest
 * Se encarga de validar la actualización de un grupo sanguíneo.
 * Permite mantener el mismo valor sin romper la regla unique.
 */
class UpdateBloodGroupRequest extends FormRequest
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
     * Define las reglas de validación para actualizar el grupo sanguíneo.
     * @return array
     */
    public function rules(): array
    {
        $bloodGroupId = $this->route('bloodGroup_id');
        return [
            /**
             * El nombre es obligatorio, cumple la regla bloodValue,
             * tiene máximo 3 caracteres y es único,
             * ignorando el registro actual.
             */
            'name' => "required|string|max:3|blood_value|unique:blood_groups,name,{$bloodGroupId}"
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
     * Nombre amigable del atributo.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => 'grupo sanguíneo',
        ];
    }
}
