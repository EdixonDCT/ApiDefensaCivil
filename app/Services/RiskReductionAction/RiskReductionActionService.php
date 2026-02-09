<?php

namespace App\Services\RiskReductionAction;

use App\Models\RiskReductionAction\RiskReductionAction;
use Exception;

class RiskReductionActionService
{
    public function __construct()
    {
        //
    }

    public function getAll()
    {
        $actions = RiskReductionAction::all();

        if ($actions->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay acciones de reducción de riesgo registradas",
                "data" => $actions,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acciones de reducción de riesgo obtenidas exitosamente",
            "data" => $actions,
        ];
    }

    public function getById($id)
    {
        $action = RiskReductionAction::with(['relatedModel1', 'relatedModel2'])->find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción de reducción de riesgo no encontrada",
            ];
        }

        // Ejemplo de relación adicional si es necesario
        $relatedData = $action->relatedData ?? null;

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción de reducción de riesgo obtenida exitosamente",
            "data" => $action,
            "related" => $relatedData,
        ];
    }

    public function getActionsForPlan($plan_id)
    {
        $paginator = RiskReductionAction::where('plan_id', $plan_id)
            ->with(['relatedModel1', 'relatedModel2'])
            ->paginate(10);

        return [
            "error" => false,
            "code" => 200,
            "message" => $paginator->isEmpty()
                ? "Este plan no tiene acciones registradas"
                : "Acciones del plan obtenidas exitosamente",
            "data" => $paginator,
        ];
    }

    public function create(array $data)
    {
        try {
            $action = RiskReductionAction::create($data);

            return [
                "error" => false,
                "code" => 201,
                "message" => "Acción de reducción de riesgo creada exitosamente",
                "data" => $action,
            ];
        } catch (Exception $e) {
            return [
                "error" => true,
                "code" => 500,
                "message" => "Error al crear la acción de reducción de riesgo",
            ];
        }
    }

    public function update(array $data, $id)
    {
        $action = RiskReductionAction::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción de reducción de riesgo no encontrada",
            ];
        }

        $action->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción de reducción de riesgo actualizada exitosamente",
            "data" => $action,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $action = RiskReductionAction::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción de reducción de riesgo no encontrada",
            ];
        }

        $action->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción de reducción de riesgo actualizada parcialmente exitosamente",
            "data" => $action,
        ];
    }

    public function delete($id)
    {
        $action = RiskReductionAction::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción de reducción de riesgo no encontrada",
            ];
        }

        $action->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción de reducción de riesgo eliminada exitosamente",
        ];
    }
}
