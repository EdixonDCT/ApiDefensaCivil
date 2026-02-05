<?php

namespace App\Services\StatusPlan;

use App\Models\StatusPlan\StatusPlan;
use Illuminate\support\Arr;

/**
 * Servicio para la gestión de los estados de los Planes Familiares.
 * Controla las etiquetas que definen el ciclo de vida de un plan operativo.
 */
class StatusPlanService
{
    /**
     * Obtiene el listado completo de estados de planes disponibles.
     */
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

    /**
     * Obtiene un estado de plan específico por su ID.
     */
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

    /**
     * Registra un nuevo tipo de estado para los planes.
     */
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

    /**
     * Actualiza el nombre o descripción de un estado de plan existente.
     */
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

    /**
     * Elimina un estado de plan.
     * Incluye validación de integridad para no afectar planes familiares en curso.
     */
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
        
        // Verifica si hay Planes Familiares que dependan de este estado
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