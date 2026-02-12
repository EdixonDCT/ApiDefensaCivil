<?php

namespace App\Services\RiskFactor;

use App\Models\RiskFactor\RiskFactor;

class RiskFactorService
{
    public function __construct()
    {
        //
    }

    // Obtener todos los factores de riesgo con relaciones
    public static function getAll()
    {
        $riskFactors = RiskFactor::with(['threatType', 'familyPlan'])->get();

        if ($riskFactors->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de factores de riesgo",
                "data" => $riskFactors,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Factores de riesgo obtenidos exitosamente",
            "data" => $riskFactors,
        ];
    }

    // Obtener factor de riesgo por ID con relaciones y datos relacionados
    public function getById($id)
    {
        $riskFactor = RiskFactor::with(['threatType', 'familyPlan'])->find($id);

        if (!$riskFactor) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Factor de riesgo no encontrado",
            ];
        }

        // Ejemplo de datos relacionados opcionales, igual que $conditionPet en PetService
        $relatedData = $riskFactor->relatedData ?? null;

        return [
            "error" => false,
            "code" => 200,
            "message" => "Factor de riesgo obtenido exitosamente",
            "data" => $riskFactor,
            "related" => $relatedData,
        ];
    }

    // Obtener factores de riesgo por plan familiar (paginado)
    public function getByFamilyPlan($family_plan_id)
    {
        $paginator = RiskFactor::where('family_plan_id', $family_plan_id)
            ->with(['threatType', 'familyPlan'])
            ->paginate(10);

        return [
            "error" => false,
            "code" => 200,
            "message" => $paginator->isEmpty()
                ? "Este plan familiar no tiene factores de riesgo registrados"
                : "Factores de riesgo del plan familiar obtenidos exitosamente",
            "data" => $paginator,
        ];
    }

    // Crear nuevo factor de riesgo
    public function create(array $data)
    {
        $riskFactor = RiskFactor::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Factor de riesgo creado exitosamente",
            "data" => $riskFactor,
        ];
    }

    // Actualización completa
    public function update(array $data, $id)
    {
        $riskFactor = RiskFactor::find($id);

        if (!$riskFactor) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Factor de riesgo no encontrado",
            ];
        }

        $riskFactor->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Factor de riesgo actualizado exitosamente",
            "data" => $riskFactor,
        ];
    }

    // Actualización parcial
    public function partialUpdate(array $data, $id)
    {
        $riskFactor = RiskFactor::find($id);

        if (!$riskFactor) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Factor de riesgo no encontrado",
            ];
        }

        $riskFactor->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Factor de riesgo actualizado parcialmente exitosamente",
            "data" => $riskFactor,
        ];
    }

    // Eliminar factor de riesgo
    public function delete($id)
    {
        $riskFactor = RiskFactor::find($id);

        if (!$riskFactor) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Factor de riesgo no encontrado",
            ];
        }

        $riskFactor->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Factor de riesgo eliminado exitosamente",
        ];
    }
}
