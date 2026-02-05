<?php

namespace App\Services\Pet;

use App\Models\Pet\pets;

class PetService
{
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $pets = pets::all();

        if ($pets->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de mascotas",
                "data" => $pets,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de mascotas obtenidos exitosamente",
            "data" => $pets,
        ];
    }

    public function getById($id)
    {
        $pet = pets::find($id);

        if (!$pet) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Mascota no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Mascota obtenida exitosamente",
            "data" => $pet,
        ];
    }

    public function create(array $data)
    {
        $pet = pets::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Mascota creada exitosamente",
            "data" => $pet,
        ];
    }

    public function update(array $data, $id)
    {
        $pet = pets::find($id);

        if (!$pet) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Mascota no encontrada",
            ];
        }

        $pet->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Mascota actualizada exitosamente",
            "data" => $pet,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $pet = pets::find($id);

        if (!$pet) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Mascota no encontrada",
            ];
        }

        $pet->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Mascota actualizada parcialmente exitosamente",
            "data" => $pet,
        ];
    }

    public function delete($id)
    {
        $pet = pets::find($id);

        if (!$pet) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Mascota no encontrada",
            ];
        }

        $pet->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Mascota eliminada exitosamente",
        ];
    }
}
