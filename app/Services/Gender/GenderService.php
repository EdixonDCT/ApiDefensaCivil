<?php

namespace App\Services\Gender;

use App\Models\Gender\Gender;
use Illuminate\support\Arr;

class GenderService
{
    public static function getAll()
    {
        $gender = Gender::all();

        if ($gender->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay generos registrados",
                "data" => $gender,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Generos obtenidos exitosamente",
            "data" => $gender,
        ];
    }

    public function getById($id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero obtenido exitosamente",
            "data" => $gender,
        ];
    }

    public function create(array $data)
    {
        $gender = Gender::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Genero creado exitosamente",
            "data" => $gender,
        ];
    }

    public function update(array $data, $id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        $gender->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero actualizado exitosamente",
            "data" => $gender,
        ];
    }

    public function partialUpdate(array $data,$id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        $gender->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero actualizado parcialmente exitosamente",
            "data" => $gender,
        ];
    }

    public function changeState(array $data,$id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        $gender->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de genero actualizado correctamente",
            "data" => $gender,
        ];
    }

    public function delete($id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }
        
        if ($gender->profile->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el genero porque tiene registros relacionados",
            ];
        }

        $gender->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero eliminado exitosamente",
        ];
    }
}
