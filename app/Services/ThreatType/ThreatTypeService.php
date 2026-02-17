<?php

namespace App\Services\ThreatType;

use App\Models\ThreatType\ThreatType;

class ThreatTypeService
{
    public function __construct()
    {
        //
    }

    // Obtener todos los tipos de amenaza
    public static function getAll()
    {
        $threatTypes = ThreatType::all();

        if ($threatTypes->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de tipos de amenaza",
                "data" => $threatTypes,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de tipos de amenaza obtenidos exitosamente",
            "data" => $threatTypes,
        ];
    }

    // Obtener tipo de amenaza por ID
    public function getById($id)
    {
        $threatType = ThreatType::find($id);

        if (!$threatType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de amenaza no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de amenaza obtenido exitosamente",
            "data" => $threatType,
        ];
    }

    // Crear nuevo tipo de amenaza
    public function create(array $data)
    {
        $threatType = ThreatType::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Tipo de amenaza creado exitosamente",
            "data" => $threatType,
        ];
    }

    // Actualización completa
    public function update(array $data, $id)
    {
        $threatType = ThreatType::find($id);

        if (!$threatType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de amenaza no encontrado",
            ];
        }

        $threatType->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de amenaza actualizado exitosamente",
            "data" => $threatType,
        ];
    }

    // Actualización parcial
    public function partialUpdate(array $data, $id)
    {
        $threatType = ThreatType::find($id);

        if (!$threatType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de amenaza no encontrado",
            ];
        }

        $threatType->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de amenaza actualizado parcialmente exitosamente",
            "data" => $threatType,
        ];
    }

    // Eliminar tipo de amenaza
    public function delete($id)
    {
        $threatType = ThreatType::find($id);

        if (!$threatType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de amenaza no encontrado",
            ];
        }

        $threatType->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de amenaza eliminado exitosamente",
        ];
    }
}
