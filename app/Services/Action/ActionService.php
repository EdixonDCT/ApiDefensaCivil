<?php

namespace App\Services\Action;

use App\Models\Action\Action;

class ActionService
{
    public function getAll()
    {
        $actions = Action::all();

        return [
            "error" => false,
            "code" => 200,
            "message" => $actions->isEmpty()
                ? "No hay acciones registradas"
                : "Acciones obtenidas exitosamente",
            "data" => $actions,
        ];
    }

    public function getById($id)
    {
        $action = Action::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción obtenida exitosamente",
            "data" => $action,
        ];
    }

    public function create(array $data)
    {
        $action = Action::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Acción creada exitosamente",
            "data" => $action,
        ];
    }

    public function update(array $data, $id)
    {
        $action = Action::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción no encontrada",
            ];
        }

        $action->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción actualizada exitosamente",
            "data" => $action,
        ];
    }

    public function delete($id)
    {
        $action = Action::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción no encontrada",
            ];
        }

        $action->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción eliminada exitosamente",
        ];
    }
}
