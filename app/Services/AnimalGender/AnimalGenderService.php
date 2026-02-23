<?php

namespace App\Services\AnimalGender;

use App\Models\AnimalGender\AnimalGender;

class AnimalGenderService
{
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $genders = AnimalGender::all();

        if ($genders->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay registros de géneros de animales",
                "data" => $genders,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Géneros de animales obtenidos exitosamente",
            "data" => $genders,
        ];
    }

    public function getById($id)
    {
        $gender = AnimalGender::find($id);

        if (!$gender) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Género de animal no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Género de animal obtenido exitosamente",
            "data" => $gender,
        ];
    }

    public function create(array $data)
    {
        $gender = AnimalGender::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Género de animal creado exitosamente",
            "data" => $gender,
        ];
    }

    public function update(array $data, $id)
    {
        $gender = AnimalGender::find($id);

        if (!$gender) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Género de animal no encontrado",
            ];
        }

        $gender->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Género de animal actualizado exitosamente",
            "data" => $gender,
        ];
    }

    public function delete($id)
    {
        $gender = AnimalGender::find($id);

        if (!$gender) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Género de animal no encontrado",
            ];
        }

        $gender->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Género de animal eliminado exitosamente",
        ];
    }
}
