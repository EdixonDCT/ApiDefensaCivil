<?php

namespace App\Services\City;

use App\Models\City\City;
use App\Models\Apartment\Apartment;
use Illuminate\support\Arr;

class CityService
{
public static function getAll()
    {
        $city = City::all();

        if ($city->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay ciudades registradas",
                "data" => $city,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "ciudades obtenidos exitosamente",
            "data" => $city,
        ];
    }

    public function getById($id)
    {
        $city = City::find($id);

        if (!$city){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Ciudad no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudad obtenida exitosamente",
            "data" => $city,
        ];
    }

    public function create(array $data)
    {
        $city = City::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Ciudades creada exitosamente",
            "data" => $city,
        ];
    }

    public function update(array $data, $id)
    {
        $city = City::find($id);

        if (!$city){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Ciudad no encontrada",
            ];
        }

        $city->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudad actualizada exitosamente",
            "data" => $city,
        ];
    }

    public function partialUpdate(array $data,$id)
    {
        $city = City::find($id);

        if (!$city){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Ciudad no encontrada",
            ];
        }

        $city->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudadad actualizada parcialmente exitosamente",
            "data" => $city,
        ];
    }

    public function changeState(array $data,$id)
    {
        $city = City::find($id);

        if (!$city){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Ciudad no encontrada",
            ];
        }

        $city->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de la ciudad actualizado correctamente",
            "data" => $city,
        ];
    }

    public function delete($id)
    {
        $city = City::find($id);

        if (!$city){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Ciudad no encontrada",
            ];
        }
        
        if ($city->familyPlan->count()){
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar la ciudad porque tiene registros relacionados",
            ];
        }

        $city->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Ciudad eliminado exitosamente",
        ];
    }
    public static function getAllForApartments($id)
    {
        $apartment = Apartment::find($id);

        if (!$apartment){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No existe esta apartamento",
                "data" => $apartment,
            ];
        }
        
        $city = $apartment->city;

        if (!$city){
        return [
            "error" => false,
            "code" => 200,
            "message" => "No existen ciudades relacionadas al apartamento",
            "data" => $city,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "ciudades obtenidos exitosamente",
            "data" => $city,
        ];
    }
}
