<?php

namespace App\Services\Resource;

use App\Models\Resource\Resource;

class ResourceService
{
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $reasons = Resource::all();

        if ($reasons->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No se encontraron registros de recursos",
                "data" => $reasons,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de recursos obtenidos correctamente",
            "data" => $reasons,
        ];
    }

    public function getById($id)
    {
        $reason = Resource::find($id);

        if (!$reason) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Recurso no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Recurso obtenido correctamente",
            "data" => $reason,
        ];
    }

    public function create(array $data)
    {
        $reason = Resource::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Recurso creado correctamente",
            "data" => $reason,
        ];
    }

    public function getResourcesForPlan($plan_id)
    {
        $paginator = Resource::where('plan_id', $plan_id)
            ->paginate(10);

        return [
            "error" => false,
            "code" => 200,
            "message" => $paginator->isEmpty()
                ? "No se encontraron recursos para este plan"
                : "Recursos del plan obtenidos correctamente",
            "data" => $paginator,
        ];
    }

    public function update(array $data, $id)
    {
        $reason = Resource::find($id);

        if (!$reason) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Recurso no encontrado",
            ];
        }

        $reason->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Recurso actualizado correctamente",
            "data" => $reason,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $reason = Resource::find($id);

        if (!$reason) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Recurso no encontrado",
            ];
        }

        $reason->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Recurso actualizado parcialmente correctamente",
            "data" => $reason,
        ];
    }

    public function delete($id)
    {
        $reason = Resource::find($id);

        if (!$reason) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Recurso no encontrado",
            ];
        }

        $reason->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Recurso eliminado correctamente",
        ];
    }
}
