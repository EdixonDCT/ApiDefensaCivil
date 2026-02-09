<?php

namespace App\Services\Pet;

use App\Models\Pet\Pet;

class PetService
{
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $Pet = Pet::all();

        if ($Pet->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de mascotas",
                "data" => $Pet,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Registros de mascotas obtenidos exitosamente",
            "data" => $Pet,
        ];
    }

    public function getById($id)
    {
        $pet = Pet::with(['species','animalGender'])->find($id);
        
        $conditionPet = $pet->petVaccine;

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
            "data" => $pet,$conditionPet,
        ];
    }
    
    public function getPetsForPlan($family_plan_id)
    {
        $paginator = Pet::where('family_plan_id', $family_plan_id)
            ->with([
                'Species',
                'AnimalGender'
            ])->paginate(10);
        return [
            "error"   => false,
            "code"    => 200,
            "message" => $paginator->isEmpty()
                ? "Este plan familiar no tiene mascotas registrados"
                : "Mascotas del plan familiar obtenidos exitosamente",
            "data"    => $paginator,
        ];
    }
    public function create(array $data)
    {
        $Pet = Pet::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Mascota creada exitosamente",
            "data" => $Pet,
        ];
    }

    public function update(array $data, $id)
    {
        $Pet = Pet::find($id);

        if (!$Pet) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Mascota no encontrada",
            ];
        }

        $Pet->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Mascota actualizada exitosamente",
            "data" => $Pet,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $Pet = Pet::find($id);

        if (!$Pet) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Mascota no encontrada",
            ];
        }

        $Pet->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Mascota actualizada parcialmente exitosamente",
            "data" => $Pet,
        ];
    }

    public function delete($id)
    {
        $Pet = Pet::find($id);

        if (!$Pet) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Mascota no encontrada",
            ];
        }

        $Pet->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Mascota eliminada exitosamente",
        ];
    }
}
