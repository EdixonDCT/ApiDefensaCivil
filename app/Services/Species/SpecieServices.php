<?php

namespace App\Services\Species;

use App\Models\Species\Species;

class SpecieServices
{
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $species = Species::all();

        if ($species->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de especies",
                "data" => $species,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de especies obtenidos exitosamente",
            "data" => $species,
        ];
    }

    public function getById($id)
    {
        $species = Species::find($id);

        if (!$species) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Especie no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Especie obtenida exitosamente",
            "data" => $species,
        ];
    }

    public function create(array $data)
    {
        $species = Species::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Especie creada exitosamente",
            "data" => $species,
        ];
    }

    public function update(array $data, $id)
    {
        $species = Species::find($id);

        if (!$species) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Especie no encontrada",
            ];
        }

        $species->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Especie actualizada exitosamente",
            "data" => $species,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $species = Species::find($id);

        if (!$species) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Especie no encontrada",
            ];
        }

        $species->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Especie actualizada parcialmente exitosamente",
            "data" => $species,
        ];
    }

    public function delete($id)
    {
        $species = Species::find($id);

        if (!$species) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Especie no encontrada",
            ];
        }

        $species->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Especie eliminada exitosamente",
        ];
    }
}
