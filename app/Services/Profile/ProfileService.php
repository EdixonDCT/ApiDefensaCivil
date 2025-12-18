<?php

namespace App\Services\Profile;

use App\Models\Profile\Profile;
use Illuminate\support\Arr;

class ProfileService
{
    public static function getAll()
    {
        $profile = Profile::all();

        if ($profile->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay estados de perfiles registrados",
                "data" => $profile,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Perfiles obtenidos exitosamente",
            "data" => $profile,
        ];
    }

    public function getById($id)
    {
        $profile = Profile::find($id);

        if (!$profile){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Perfil no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Perfil obtenido exitosamente",
            "data" => $profile,
        ];
    }

    public function create(array $data)
    {
        $profile = Profile::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Perfil creado exitosamente",
            "data" => $profile,
        ];
    }

    public function update(array $data, $id)
    {
        $profile = Profile::find($id);

        if (!$profile){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Perfil no encontrado",
            ];
        }

        $profile->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Perfil actualizado exitosamente",
            "data" => $profile,
        ];
    }

    public function partialUpdate(array $data,$id)
    {
        $profile = Profile::find($id);

        if (!$profile){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organizacion no encontrado",
            ];
        }

        $profile->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Perfil actualizado parcialmente exitosamente",
            "data" => $profile,
        ];
    }

    public function delete($id)
    {
        $profile = Profile::find($id);

        if (!$profile){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Perfil no encontrado",
            ];
        }
        

        $profile->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Perfil eliminado exitosamente",
        ];
    }
}
