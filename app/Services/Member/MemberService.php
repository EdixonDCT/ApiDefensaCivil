<?php

namespace App\Services\Member;

use App\Models\Member\Member;
use App\Models\FamilyMember\FamilyMember;
use Illuminate\Support\Facades\DB;

/**
 * Servicio para la gestión de los miembros.
 * Centraliza la lógica de negocio sin manejar autorización.
 */
class MemberService
{
    /**
     * Obtiene todos los miembros.
     */
    public function getAll()
    {
        $members = Member::all();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembros obtenidos exitosamente",
            "data" => $members,
        ];
    }

    /**
     * Obtiene un miembro por ID.
     */
    public function getById($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro obtenido exitosamente",
            "data" => $member,
        ];
    }

    /**
     * Crea un nuevo miembro y lo asocia a un plan familiar.
     * Usa transacción para garantizar integridad de datos.
     */
    public function create(array $data,$plan_id)
    {
        DB::beginTransaction();

        try {
            // 1. Crear el miembro
            $member = Member::create($data);

            // 2. Crear relación con el plan familiar
            FamilyMember::create([
                'member_id'      => $member->id,
                'family_plan_id' => $plan_id,
            ]);

            // 3. Confirmar transacción
            DB::commit();

            return [
                "error" => false,
                "code" => 201,
                "message" => "Miembro creado y asociado al plan familiar exitosamente",
                "data" => $member,
            ];
        } catch (\Throwable $e) {

            // Si algo falla, se revierte todo
            DB::rollBack();

            return [
                "error" => true,
                "code" => 500,
                "message" => "Error al crear el miembro y asociarlo al plan familiar",
                "details" => $e->getMessage(), // útil para debug (puedes quitarlo en prod)
            ];
        }
    }

    /**
     * Actualiza un miembro (PUT).
     */
    public function update(array $data, $id)
    {
        $member = Member::find($id);

        if (!$member) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro no encontrado",
            ];
        }

        $member->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro actualizado exitosamente",
            "data" => $member,
        ];
    }

    /**
     * Actualización parcial de un miembro (PATCH).
     */
    public function partialUpdate(array $data, $id)
    {
        $member = Member::find($id);

        if (!$member) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro no encontrado",
            ];
        }

        $member->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro actualizado parcialmente exitosamente",
            "data" => $member,
        ];
    }

    /**
     * Elimina un miembro.
     */
    public function delete($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro no encontrado",
            ];
        }

        $member->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro eliminado exitosamente",
        ];
    }
}
