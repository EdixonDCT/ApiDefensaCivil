<?php

namespace App\Http\Requests\ConditionMember;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request para actualizar un registro de ConditionMember.
 *
 * Valida que los datos enviados para modificar la relación
 * entre un miembro y un tipo de condición sean correctos.
 */
class UpdateConditionMemberRequest extends FormRequest
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
     * Reglas de validación para actualizar un ConditionMember.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // El member_id puede actualizarse, pero debe existir en members
            'member_id'         => 'required|exists:members,id',

            // El condition_type_id puede actualizarse, pero debe existir en condition_types
            'condition_type_id' => 'required|exists:condition_types,id',

            // Nombre de la condición, obligatorio, máximo 50 caracteres
            'name'              => 'required|string|max:50',

            // Dosis o detalle adicional, opcional, máximo 255 caracteres
            'dose'              => 'nullable|string|max:255',
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
            'member_id.required'         => 'El :attribute es obligatorio',
            'member_id.exists'           => 'El :attribute seleccionado no existe',
            'condition_type_id.required' => 'El :attribute es obligatorio',
            'condition_type_id.exists'   => 'El :attribute seleccionado no existe',
            'name.required'              => 'El :attribute es obligatorio',
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
            'member_id'         => 'integrante',
            'condition_type_id' => 'tipo de condición',
            'name'              => 'nombre de la condición',
            'dose'              => 'dosis o detalle',
        ];
    }
}
