<?php

namespace App\Services\BloodGroup;

use App\Models\BloodGroup\BloodGroup;

/**
 * Servicio para la gestión de los grupos sanguíneos.
 * Controla el catálogo base de grupos utilizados en el sistema.
 */
class BloodGroupService
{
    /**
     * Obtiene el listado completo de grupos sanguíneos disponibles.
     */
    public static function getAll()
    {
        $bloodGroups = BloodGroup::all();

        if ($bloodGroups->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay grupos sanguíneos registrados",
                "data" => $bloodGroups,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Grupos sanguíneos obtenidos exitosamente",
            "data" => $bloodGroups,
        ];
    }

    /**
     * Obtiene un grupo sanguíneo específico por su ID.
     */
    public function getById($id)
    {
        $bloodGroup = BloodGroup::find($id);

        if (!$bloodGroup) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Grupo sanguíneo no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Grupo sanguíneo obtenido exitosamente",
            "data" => $bloodGroup,
        ];
    }

    /**
     * Registra un nuevo grupo sanguíneo.
     */
    public function create(array $data)
    {
        $bloodGroup = BloodGroup::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Grupo sanguíneo creado exitosamente",
            "data" => $bloodGroup,
        ];
    }

    /**
     * Actualiza un grupo sanguíneo existente.
     */
    public function update(array $data, $id)
    {
        $bloodGroup = BloodGroup::find($id);

        if (!$bloodGroup) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Grupo sanguíneo no encontrado",
            ];
        }

        $bloodGroup->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Grupo sanguíneo actualizado exitosamente",
            "data" => $bloodGroup,
        ];
    }

    /**
     * Elimina un grupo sanguíneo.
     * Valida que no esté siendo usado por usuarios.
     */
    public function delete($id)
    {
        $bloodGroup = BloodGroup::find($id);

        if (!$bloodGroup) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Grupo sanguíneo no encontrado",
            ];
        }

        $bloodGroup->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Grupo sanguíneo eliminado exitosamente",
        ];
    }
}
