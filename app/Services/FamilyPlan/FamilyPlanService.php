<?php

namespace App\Services\FamilyPlan;

use App\Models\FamilyPlan\FamilyPlan;
use App\Models\History\History;
use Illuminate\support\Arr;

class FamilyPlanService
{
public static function getAll()
    {
        $familyPlan = FamilyPlan::all();

        if ($familyPlan->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay planes familiares registrados",
                "data" => $familyPlan,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "planes familiares obtenidos exitosamente",
            "data" => $familyPlan,
        ];
    }

    public function getById($id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan familiar obtenido exitosamente",
            "data" => $familyPlan,
        ];
    }

    public function create(array $data)
    {
        $familyPlan = FamilyPlan::create($data);

        History::create([
        'user_id' => auth()->id(), // ID del usuario autenticado
        'family_plan_id' => $familyPlan->id,
        'action_id' => 1, // estado "creado"
        // 'date' y 'time' se llenan automáticamente desde el modelo
        ]);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Plan familiar creado exitosamente",
            "data" => $familyPlan,
        ];
    }

    public function update(array $data, $id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        $familyPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan familiar actualizado exitosamente",
            "data" => $familyPlan,
        ];
    }

    public function partialUpdate(array $data,$id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        $familyPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan familiar actualizado parcialmente exitosamente",
            "data" => $familyPlan,
        ];
    }

    public function changeState(array $data,$id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        $familyPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado del plan familiar actualizado correctamente",
            "data" => $familyPlan,
        ];
    }

    public function georeferencing(array $data,$id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        $familyPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Georreferenciacion del plan familiar actualizado correctamente",
            "data" => $familyPlan,
        ];
    }

    public function identify(array $data,$id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        $familyPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Identificacion del plan familiar actualizado correctamente",
            "data" => $familyPlan,
        ];
    }

    public function delete($id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        $familyPlan->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan familiar eliminado exitosamente",
        ];
    }
}
