<?php

namespace App\Services\AvailableResource;

use App\Models\AvailableResource\AvailableResource;

class AvailableResourceService
{
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $resources = AvailableResource::all();

        if ($resources->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de recursos disponibles",
                "data" => $resources,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de recursos disponibles obtenidos exitosamente",
            "data" => $resources,
        ];
    }

    public function getById($id)
    {
        $resource = AvailableResource::find($id);

        if (!$resource) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Recurso disponible no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Recurso disponible obtenido exitosamente",
            "data" => $resource,
        ];
    }

    public function create(array $data)
    {
        $resource = AvailableResource::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Recurso disponible creado exitosamente",
            "data" => $resource,
        ];
    }

    public function update(array $data, $id)
    {
        $resource = AvailableResource::find($id);

        if (!$resource) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Recurso disponible no encontrado",
            ];
        }

        $resource->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Recurso disponible actualizado exitosamente",
            "data" => $resource,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $resource = AvailableResource::find($id);

        if (!$resource) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Recurso disponible no encontrado",
            ];
        }

        $resource->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Recurso disponible actualizado parcialmente exitosamente",
            "data" => $resource,
        ];
    }

    public function delete($id)
    {
        $resource = AvailableResource::find($id);

        if (!$resource) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Recurso disponible no encontrado",
            ];
        }

        $resource->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Recurso disponible eliminado exitosamente",
        ];
    }
}
