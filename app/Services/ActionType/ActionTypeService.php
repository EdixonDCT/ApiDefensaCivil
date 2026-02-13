<?php

namespace App\Services\ActionType;

use App\Models\ActionType\ActionType;

class ActionTypeService
{
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $actionTypes = ActionType::all();

        if ($actionTypes->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de tipos de acción",
                "data" => $actionTypes,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de tipos de acción obtenidos exitosamente",
            "data" => $actionTypes,
        ];
    }

    public function getById($id)
    {
        $actionType = ActionType::find($id);

        if (!$actionType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de acción no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de acción obtenido exitosamente",
            "data" => $actionType,
        ];
    }

    public function create(array $data)
    {
        $actionType = ActionType::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Tipo de acción creado exitosamente",
            "data" => $actionType,
        ];
    }

    public function update(array $data, $id)
    {
        $actionType = ActionType::find($id);

        if (!$actionType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de acción no encontrado",
            ];
        }

        $actionType->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de acción actualizado exitosamente",
            "data" => $actionType,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $actionType = ActionType::find($id);

        if (!$actionType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de acción no encontrado",
            ];
        }

        $actionType->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de acción actualizado parcialmente exitosamente",
            "data" => $actionType,
        ];
    }

    public function delete($id)
    {
        $actionType = ActionType::find($id);

        if (!$actionType) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Tipo de acción no encontrado",
            ];
        }

        $actionType->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Tipo de acción eliminado exitosamente",
        ];
    }
}
