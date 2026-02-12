<?php

namespace App\Services\RiskReductionAction;

use App\Models\RiskReductionAction\RiskReductionAction;
use App\Models\RiskFactor\RiskFactor;

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
        $action = RiskReductionAction::find($id);

        if (!$action) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Acción de reducción de riesgo no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acción de reducción de riesgo obtenida exitosamente",
            "data" => $action,
        ];
    }

    public function getByRiskFactor($riskFactor_id)
    {
        $riskFactor = RiskReductionAction::with('member')->where('risk_factor_id', $riskFactor_id)->get();

        if ($riskFactor->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "Este factor de riesgo no tiene acciones registradas",
                "data" => $riskFactor,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Acciones de reducción de riesgo del factor obtenidas exitosamente",
            "data" => $riskFactor,
        ];
    }

    public function create(array $data)
    {
        $action = RiskReductionAction::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Acción de reducción de riesgo creada exitosamente",
            "data" => $action,
        ];
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
