<?php

namespace App\Services\PetVaccine;

use App\Models\PetVaccine\PetVaccine;

class PetVaccineService
{
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $vaccines = PetVaccine::all();

        if ($vaccines->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de vacunas",
                "data" => $vaccines,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de vacunas obtenidos exitosamente",
            "data" => $vaccines,
        ];
    }

    public function getById($id)
    {
        $vaccine = PetVaccine::find($id);

        if (!$vaccine) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Vacuna no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Vacuna obtenida exitosamente",
            "data" => $vaccine,
        ];
    }

    public function create(array $data)
    {
        $vaccine = PetVaccine::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Vacuna creada exitosamente",
            "data" => $vaccine,
        ];
    }

    public function update(array $data, $id)
    {
        $vaccine = PetVaccine::find($id);

        if (!$vaccine) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Vacuna no encontrada",
            ];
        }

        $vaccine->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Vacuna actualizada exitosamente",
            "data" => $vaccine,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $vaccine = PetVaccine::find($id);

        if (!$vaccine) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Vacuna no encontrada",
            ];
        }

        $vaccine->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Vacuna actualizada parcialmente exitosamente",
            "data" => $vaccine,
        ];
    }

    public function delete($id)
    {
        $vaccine = PetVaccine::find($id);

        if (!$vaccine) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Vacuna no encontrada",
            ];
        }

        $vaccine->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Vacuna eliminada exitosamente",
        ];
    }
}
