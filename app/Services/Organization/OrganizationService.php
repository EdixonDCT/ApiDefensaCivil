<?php

namespace App\Services\Organization;

use App\Models\Organization\Organization;
use App\Models\Sectional\Sectional;
use Illuminate\support\Arr;

class OrganizationService
{
public static function getAll()
    {
        $organization = Organization::all();

        if ($organization->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay organizaciones registradas",
                "data" => $organization,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "organizaciones obtenidos exitosamente",
            "data" => $organization,
        ];
    }

    public function getById($id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organizacion obtenido exitosamente",
            "data" => $organization,
        ];
    }

    public function create(array $data)
    {
        $organization = Organization::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Organizacion creado exitosamente",
            "data" => $organization,
        ];
    }

    public function update(array $data, $id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }

        $organization->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organizacion actualizado exitosamente",
            "data" => $organization,
        ];
    }

    public function partialUpdate(array $data,$id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }

        $organization->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organizacion actualizado parcialmente exitosamente",
            "data" => $organization,
        ];
    }

    public function changeState(array $data,$id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }

        $organization->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de organizacion actualizado correctamente",
            "data" => $organization,
        ];
    }

    public function delete($id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }
        
        if ($organization->profile->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar la organizacion porque tiene registros relacionados",
            ];
        }

        $organization->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organizacion eliminado exitosamente",
        ];
    }
    public static function getAllForSectional($id)
    {
        $sectional = Sectional::find($id);

        if (!$sectional){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No existe esta seccional",
                "data" => $sectional,
            ];
        }
        
        $organization = $sectional->organization;

        if (!$organization){
        return [
            "error" => false,
            "code" => 200,
            "message" => "No existen organizacion relacionadas a la seccional",
            "data" => $organization,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "organizaciones obtenidos exitosamente",
            "data" => $organization,
        ];
    }
}
