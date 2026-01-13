<?php

namespace App\Services\Sector;

use App\Models\Sector\Sector;
use Illuminate\support\Arr;

class SectorService
{
    public static function getAll()
    {
        $sector = Sector::all();

        if ($sector->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay sectores registrados",
                "data" => $sector,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Sectores obtenidos exitosamente",
            "data" => $sector,
        ];
    }

    public function getById($id)
    {
        $sector = Sector::find($id);

        if (!$sector){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Sector no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Sector obtenido exitosamente",
            "data" => $sector,
        ];
    }

    public function create(array $data)
    {
        $sector = Sector::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Sector creado exitosamente",
            "data" => $sector,
        ];
    }

    public function update(array $data, $id)
    {
        $sector = Sector::find($id);

        if (!$sector){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Sector no encontrado",
            ];
        }

        $sector->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Sector actualizado exitosamente",
            "data" => $sector,
        ];
    }

    public function partialUpdate(array $data,$id)
    {
        $sector = Sector::find($id);

        if (!$sector){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Sector no encontrado",
            ];
        }

        $sector->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Sector actualizado parcialmente exitosamente",
            "data" => $sector,
        ];
    }

    public function changeState(array $data,$id)
    {
        $sector = Sector::find($id);

        if (!$sector){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Sector no encontrado",
            ];
        }

        $sector->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de sector actualizado correctamente",
            "data" => $sector,
        ];
    }

    public function delete($id)
    {
        $sector = Sector::find($id);

        if (!$sector){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Sector no encontrado",
            ];
        }
        
        if ($sector->familyPlan->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el sector porque tiene registros relacionados",
            ];
        }

        $sector->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Sector eliminado exitosamente",
        ];
    }
}
