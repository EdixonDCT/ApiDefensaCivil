<?php

namespace App\Services\ActionPlan;

use App\Models\ActionPlan\ActionPlan;
use App\Models\FamilyPlan\FamilyPlan;

class ActionPlanService
{
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $actionPlan = ActionPlan::all();

        if ($actionPlan->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de planes de acción",
                "data" => $actionPlan,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de planes de acción obtenidos exitosamente",
            "data" => $actionPlan,
        ];
    }

    public function getById($id)
    {
        $actionPlan = ActionPlan::find($id);

        if (!$actionPlan) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan de acción no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan de acción obtenido exitosamente",
            "data" => $actionPlan,
        ];
    }

    public function getByPlan($familyPlanId)
    {
        $actionPlan = ActionPlan::whereHas('riskFactor', function ($query) use ($familyPlanId) {
            $query->where('family_plan_id', $familyPlanId);
        })->first();

        if (!$actionPlan) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "No existe un plan de acción para este plan familiar",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan de acción obtenido exitosamente",
            "data" => $actionPlan,
        ];
    }

    public function getByPlanBoolean($familyPlanId)
    {
        $actionPlan = ActionPlan::whereHas('riskFactor', function ($query) use ($familyPlanId) {
            $query->where('family_plan_id', $familyPlanId);
        })->first();

        if (!$actionPlan) return false;

        return true;
    }


    public function create(array $data)
    {
        $actionPlan = ActionPlan::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Plan de acción creado exitosamente",
            "data" => $actionPlan,
        ];
    }

    public function update(array $data, $id)
    {
        $actionPlan = ActionPlan::find($id);

        if (!$actionPlan) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan de acción no encontrado",
            ];
        }

        $actionPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan de acción actualizado exitosamente",
            "data" => $actionPlan,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $actionPlan = ActionPlan::find($id);

        if (!$actionPlan) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan de acción no encontrado",
            ];
        }

        $actionPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan de acción actualizado parcialmente exitosamente",
            "data" => $actionPlan,
        ];
    }

    public function delete($id)
    {
        $actionPlan = ActionPlan::find($id);

        if (!$actionPlan) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan de acción no encontrado",
            ];
        }

        $actionPlan->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan de acción eliminado exitosamente",
        ];
    }
}
