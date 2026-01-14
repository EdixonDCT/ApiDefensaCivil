<?php

namespace App\Services\StatusPlan;

use App\Models\StatusPlan\StatusPlan;
use Illuminate\support\Arr;

class StatusPlanService
{
    public static function getAll()
    {
        $statusPlan = StatusPlan::all();

        if ($statusPlan->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay estados de planes registrados",
                "data" => $statusPlan,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estados de planes obtenidos exitosamente",
            "data" => $statusPlan,
        ];
    }

    public function getById($id)
    {
        $statusPlan = StatusPlan::find($id);

        if (!$statusPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Estado de plan no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado de plan obtenido exitosamente",
            "data" => $statusPlan,
        ];
    }

    public function create(array $data)
    {
        $statusPlan = StatusPlan::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Estado de plan creado exitosamente",
            "data" => $statusPlan,
        ];
    }

    public function update(array $data, $id)
    {
        $statusPlan = StatusPlan::find($id);

        if (!$statusPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Estado de plan no encontrado",
            ];
        }

        $statusPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado de plan actualizado exitosamente",
            "data" => $statusPlan,
        ];
    }

    public function delete($id)
    {
        $statusPlan = StatusPlan::find($id);

        if (!$statusPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Estado de plan no encontrado",
            ];
        }
        
        if ($statusPlan->familyPlan->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el estado de plan porque tiene registros relacionados",
            ];
        }

        $statusPlan->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado de plan eliminado exitosamente",
        ];
    }
}
