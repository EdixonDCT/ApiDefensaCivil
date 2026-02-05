<?php

namespace App\Http\Requests\ConditionMember;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request para actualización parcial (PATCH) de ConditionMember.
 *
 * Permite modificar solo los campos enviados,
 * validando que sean correctos si existen.
 */
class PartialUpdateConditionMemberRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta petición.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualización parcial.
     *
     * Todos los campos son opcionales, pero si vienen deben ser válidos.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // El member_id es opcional, pero si se envía debe existir en members
            'member_id'         => 'sometimes|exists:members,id',

            // El condition_type_id es opcional, pero si se envía debe existir en condition_types
            'condition_type_id' => 'sometimes|exists:condition_types,id',

            // Nombre de la condición, opcional, máximo 50 caracteres
            'name'              => 'sometimes|string|max:50',

            // Dosis o detalle adicional, opcional, máximo 255 caracteres
            'dose'              => 'sometimes|string|max:255',
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
            'member_id.exists'           => 'El :attribute seleccionado no existe',
            'condition_type_id.exists'   => 'El :attribute seleccionado no existe',
            'name.string'                => 'El :attribute debe ser de tipo texto',
            'name.max'                   => 'El :attribute tiene un máximo de 50 caracteres',
            'dose.string'                => 'El :attribute debe ser de tipo texto',
            'dose.max'                   => 'El :attribute tiene un máximo de 255 caracteres',
        ];
    }

    /**
     * Nombres personalizados para los atributos.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'member_id'         => 'miembro',
            'condition_type_id' => 'tipo de condición',
            'name'              => 'nombre de la condición',
            'dose'              => 'dosis o detalle',
        ];
    }
}
