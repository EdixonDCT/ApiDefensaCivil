<?php

namespace App\Http\Requests\FamilyMember;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UpdateFamilyMemberRequest
 * Valida la actualización de la relación entre un miembro y un plan familiar.
 * Gestiona la excepción de unicidad para evitar duplicados dentro del mismo plan.
 */
class UpdateFamilyMemberRequest extends FormRequest
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
         * Capturamos el ID del registro family_member desde la ruta.
         */
        $familyMemberId = $this->route('family_member_id');

        return [
            /**
             * El plan familiar debe existir en la base de datos.
             */
            'family_plan_id' => 'required|integer|exists:family_plans,id',

            /**
             * El miembro debe existir y no duplicarse dentro del mismo plan familiar,
             * ignorando el registro actual.
             */
            'member_id' => 'required|integer|exists:members,id|unique:family_members,member_id,' 
                . $familyMemberId . ',id,family_plan_id,' . $this->family_plan_id,
        ];
    }

    /**
     * Mensajes de error personalizados sin punto final.
     * @return array
     */
    public function messages(): array
    {
        return [
            // Validaciones del Plan Familiar
            'family_plan_id.required' => 'El :attribute es obligatorio',
            'family_plan_id.integer'  => 'El :attribute debe ser un número válido',
            'family_plan_id.exists'   => 'El :attribute no existe en el sistema',

            // Validaciones del Miembro
            'member_id.required' => 'El :attribute es obligatorio',
            'member_id.integer'  => 'El :attribute debe ser un número válido',
            'member_id.exists'   => 'El :attribute no existe en el sistema',
            'member_id.unique'   => 'El miembro ya se encuentra asociado a este plan familiar',
        ];
    }

    /**
     * Atributos amigables para los mensajes de error.
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
