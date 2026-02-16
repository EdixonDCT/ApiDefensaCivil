<?php

namespace App\Services\ActionPlanAction;

use App\Models\ActionPlanAction\ActionPlanAction;

class ActionPlanActionService
{
    public function __construct()
    {
        //
    }

    public function getAll()
    {
        $actions = ActionPlanAction::all();

        if ($actions->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de acciones del plan",
                "data" => $actions,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acciones del plan obtenidas exitosamente",
            "data" => $actions,
        ];
    }

    public function getById($id)
    {
        $action = ActionPlanAction::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción del plan no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción del plan obtenida exitosamente",
            "data" => $action,
        ];
    }

    public function create(array $data)
    {
        $action = ActionPlanAction::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Acción del plan creada exitosamente",
            "data" => $action,
        ];
    }

    public function update(array $data, $id)
    {
        $action = ActionPlanAction::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción del plan no encontrada",
            ];
        }

        $action->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción del plan actualizada exitosamente",
            "data" => $action,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $action = ActionPlanAction::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción del plan no encontrada",
            ];
        }

        $action->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción del plan actualizada parcialmente exitosamente",
            "data" => $action,
        ];
    }

    public function delete($id)
    {
        $action = ActionPlanAction::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción del plan no encontrada",
            ];
        }

        $action->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción del plan eliminada exitosamente",
        ];
    }
}
