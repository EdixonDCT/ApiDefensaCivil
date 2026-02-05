<?php

namespace App\Services\ConditionMember;

use App\Models\ConditionMember\ConditionMember;

/**
 * Servicio para gestionar la lógica de negocio
 * de los registros de ConditionMember.
 */
class ConditionMemberService
{
    /**
     * Obtiene la lista completa de ConditionMember.
     *
     * @return array Respuesta con la colección de registros.
     */
    public static function getAll()
    {
        $conditionMembers = ConditionMember::all();

        if ($conditionMembers->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de condición de miembros",
                "data" => $conditionMembers,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de condición de miembros obtenidos exitosamente",
            "data" => $conditionMembers,
        ];
    }

    /**
     * Obtiene un registro específico por su ID.
     *
     * @param int|string $id ID del registro
     * @return array
     */
    public function getById($id)
    {
        $conditionMember = ConditionMember::with('conditionType')->find($id);

        if (!$conditionMember) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Registro de condición de miembro no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registro de condición de miembro obtenido exitosamente",  
            "data" => $conditionMember,
        ];
    }

    /**
     * Obtiene todos los registros de un miembro específico.
     *
     * @param int|string $member_id ID del miembro
     * @return array
     */
    public function getByMember($member_id)
    {
        $conditionMembers = ConditionMember::with('conditionType')->where('member_id', $member_id)->get();

        if ($conditionMembers->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "Este miembro no tiene registros de condición",
                "data" => $conditionMembers,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de condición del miembro obtenidos exitosamente",
            "data" => $conditionMembers,
        ];
    }

    /**
     * Crea un nuevo registro de ConditionMember.
     *
     * @param array $data Datos para la creación
     * @return array
     */
    public function create(array $data)
    {
        $conditionMember = ConditionMember::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Registro de condición de miembro creado exitosamente",
            "data" => $conditionMember,
        ];
    }

    /**
     * Actualización total de un registro (PUT).
     *
     * @param array $data Datos a actualizar
     * @param int|string $id ID del registro
     * @return array
     */
    public function update(array $data, $id)
    {
        $conditionMember = ConditionMember::find($id);

        if (!$conditionMember) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Registro de condición de miembro no encontrado",
            ];
        }

        $conditionMember->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registro de condición de miembro actualizado exitosamente",
            "data" => $conditionMember,
        ];
    }

    /**
     * Actualización parcial de un registro (PATCH).
     *
     * @param array $data Campos a modificar
     * @param int|string $id ID del registro
     * @return array
     */
    public function partialUpdate(array $data, $id)
    {
        $conditionMember = ConditionMember::find($id);

        if (!$conditionMember) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Registro de condición de miembro no encontrado",
            ];
        }

        $conditionMember->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registro de condición de miembro actualizado parcialmente exitosamente",
            "data" => $conditionMember,
        ];
    }

    /**
     * Elimina un registro de ConditionMember.
     *
     * @param int|string $id ID del registro
     * @return array
     */
    public function delete($id)
    {
        $conditionMember = ConditionMember::find($id);

        if (!$conditionMember) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Registro de condición de miembro no encontrado",
            ];
        }

        $conditionMember->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registro de condición de miembro eliminado exitosamente",
        ];
    }
}
