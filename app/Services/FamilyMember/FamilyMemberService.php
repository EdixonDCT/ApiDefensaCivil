<?php

namespace App\Services\FamilyMember;

use App\Models\FamilyMember\FamilyMember;

/**
 * Servicio encargado de la gestión de los miembros asociados a planes familiares.
 */
class FamilyMemberService
{
    /**
     * Obtiene la lista completa de relaciones familiares registradas.
     * @return array
     */
    public static function getAll()
    {
        $familyMembers = FamilyMember::all();

        if ($familyMembers->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay miembros asociados a planes familiares",
                "data" => $familyMembers,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembros asociados a planes familiares obtenidos exitosamente",
            "data" => $familyMembers,
        ];
    }

    /**
     * Busca una relación familiar por su ID.
     * @param int|string $id
     * @return array
     */
    public function getById($id)
    {
        $familyMember = FamilyMember::find($id);

        if (!$familyMember) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro del plan familiar no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro del plan familiar obtenido exitosamente",
            "data" => $familyMember,
        ];
    }

    /**
     * Crea una nueva relación entre un miembro y un plan familiar.
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $familyMember = FamilyMember::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Miembro agregado al plan familiar exitosamente",
            "data" => $familyMember,
        ];
    }

    /**
     * Actualización total de la relación familiar.
     */
    public function update(array $data, $id)
    {
        $familyMember = FamilyMember::find($id);

        if (!$familyMember) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro del plan familiar no encontrado",
            ];
        }

        $familyMember->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro del plan familiar actualizado exitosamente",
            "data" => $familyMember,
        ];
    }

    /**
     * Actualización parcial de la relación familiar.
     */
    public function partialUpdate(array $data, $id)
    {
        $familyMember = FamilyMember::find($id);

        if (!$familyMember) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro del plan familiar no encontrado",
            ];
        }

        $familyMember->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro del plan familiar actualizado parcialmente exitosamente",
            "data" => $familyMember,
        ];
    }

    /**
     * Elimina la relación entre el miembro y el plan familiar.
     * @param int|string $id
     * @return array
     */
    public function delete($id)
    {
        $familyMember = FamilyMember::find($id);

        if (!$familyMember) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro del plan familiar no encontrado",
            ];
        }

        $familyMember->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro eliminado del plan familiar exitosamente",
        ];
    }
}
