<?php

namespace App\Services\Kinship;

use App\Models\Kinship\Kinship;

/**
 * Servicio para la gestión de los parentescos.
 * Controla el catálogo base de parentescos utilizados en el sistema.
 */
class KinshipService
{
    /**
     * Obtiene el listado completo de parentescos disponibles.
     */
    public static function getAll()
    {
        $kinships = Kinship::all();

        if ($kinships->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay parentescos registrados",
                "data" => $kinships,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Parentescos obtenidos exitosamente",
            "data" => $kinships,
        ];
    }

    /**
     * Obtiene un parentesco específico por su ID.
     */
    public function getById($id)
    {
        $kinship = Kinship::find($id);

        if (!$kinship) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Parentesco no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Parentesco obtenido exitosamente",
            "data" => $kinship,
        ];
    }

    /**
     * Registra un nuevo parentesco.
     */
    public function create(array $data)
    {
        $kinship = Kinship::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Parentesco creado exitosamente",
            "data" => $kinship,
        ];
    }

    /**
     * Actualiza un parentesco existente.
     */
    public function update(array $data, $id)
    {
        $kinship = Kinship::find($id);

        if (!$kinship) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Parentesco no encontrado",
            ];
        }

        $kinship->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Parentesco actualizado exitosamente",
            "data" => $kinship,
        ];
    }

    /**
     * Elimina un parentesco.
     */
    public function delete($id)
    {
        $kinship = Kinship::find($id);

        if (!$kinship) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Parentesco no encontrado",
            ];
        }

        $kinship->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Parentesco eliminado exitosamente",
        ];
    }
}
