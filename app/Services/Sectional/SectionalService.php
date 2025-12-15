<?php

namespace App\Services\Sectional;

use App\Models\Sectional\Sectional;
use Illuminate\support\Arr;

class SectionalService
{
    public static function getAll()
    {
        $sectional = Sectional::all();
        if ($sectional->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay seccionales registradas",
                "data" => $sectional,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Seccionales obtenidas exitosamente",
            "data" => $sectional,
        ];
    }

    public function getById($id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Seccional no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Seccional obtenida exitosamente",
            "data" => $sectional,
        ];
    }

    public function create(array $data)
    {
        $sectional = Sectional::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Seccional creada exitosamente",
            "data" => $sectional,
        ];
    }

    public function update(array $data, $id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Seccional no encontrada",
            ];
        }

        $sectional->update($data);
        return [
            "error" => false,
            "code" => 200,
            "message" => "Seccional actualizada exitosamente",
            "data" => $sectional,
        ];
    }

    public function partialUpdate(array $data,$id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Seccional no encontrada",
            ];
        }

        $sectional->update($data);
        return [
            "error" => false,
            "code" => 200,
            "message" => "Seccional actualizado parcialmente exitosamente",
            "data" => $sectional,
        ];
    }

    public function changeState(array $data,$id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Seccional no encontrada",
            ];
        }

        $sectional->update($data);
        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de seccional actualizado correctamente",
            "data" => $sectional,
        ];
    }

    public function delete($id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Seccional no encontrada",
            ];
        }

        if ($sectional->organization->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el seccional porque tiene registros relacionados",
            ];
        }

        $sectional->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Seccional eliminado exitosamente",
        ];
    }
}
