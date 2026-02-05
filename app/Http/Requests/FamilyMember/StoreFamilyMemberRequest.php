<?php

namespace App\Http\Requests\FamilyMember;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase StoreFamilyMemberRequest
 * Valida los datos necesarios para asociar un miembro a un plan familiar.
 */
class StoreFamilyMemberRequest extends FormRequest
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
     * Define las reglas de validación para crear la relación familiar.
     * @return array
     */
    public function rules(): array
    {
        return [
            /**
             * El plan familiar debe existir en la base de datos.
             */
            'family_plan_id' => 'required|integer|exists:family_plans,id',

            /**
             * El miembro debe existir en la base de datos.
             * Se evita duplicar el mismo miembro dentro del mismo plan familiar.
             */
            'member_id' => 'required|integer|exists:members,id|unique:family_members,member_id,NULL,id,family_plan_id,' . $this->family_plan_id,
        ];
    }

    /**
     * Mensajes de error personalizados sin punto final.
     * @return array
     */
    public function messages(): array
    {
        return [
            // Validaciones para family_plan_id
            'family_plan_id.required' => 'El :attribute es obligatorio',
            'family_plan_id.integer'  => 'El :attribute debe ser un número válido',
            'family_plan_id.exists'   => 'El :attribute no existe en el sistema',

            // Validaciones para member_id
            'member_id.required' => 'El :attribute es obligatorio',
            'member_id.integer'  => 'El :attribute debe ser un número válido',
            'member_id.exists'   => 'El :attribute no existe en el sistema',
            'member_id.unique'   => 'El miembro ya se encuentra asociado a este plan familiar',
        ];
    }

    /**
     * Nombres amigables de los campos.
     * @return array
     */
    public function attributes(): array
    {
        return [
            'family_plan_id' => 'plan familiar',
            'member_id'      => 'miembro',
        ];
    }
}
