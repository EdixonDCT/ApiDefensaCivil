<?php

namespace App\Services\Apartment;

use App\Models\Apartment\Apartment;
use App\Models\Sectional\Sectional;
use Illuminate\support\Arr;

class ApartmentService
{
public static function getAll()
    {
        $apartment = Apartment::all();

        if ($apartment->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay apartamentos registradas",
                "data" => $apartment,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "apartamentos obtenidos exitosamente",
            "data" => $apartment,
        ];
    }

    public function getById($id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Apartamento no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Apartamento obtenido exitosamente",
            "data" => $apartment,
        ];
    }

    public function create(array $data)
    {
        $apartment = Apartment::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Apartamento creado exitosamente",
            "data" => $apartment,
        ];
    }

    public function update(array $data, $id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Apartamento no encontrado",
            ];
        }

        $apartment->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Apartamento actualizado exitosamente",
            "data" => $apartment,
        ];
    }

    public function partialUpdate(array $data,$id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Apartamento no encontrado",
            ];
        }

        $apartment->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Apartamento actualizado parcialmente exitosamente",
            "data" => $apartment,
        ];
    }

    public function changeState(array $data,$id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Apartamento no encontrado",
            ];
        }

        $apartment->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de apartamento actualizado correctamente",
            "data" => $apartment,
        ];
    }

    public function delete($id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Apartamento no encontrado",
            ];
        }
        
        if ($apartment->city->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar la Apartamento porque tiene registros relacionados",
            ];
        }

        $apartment->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Apartamento eliminado exitosamente",
        ];
    }
}
