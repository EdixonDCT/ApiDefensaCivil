<?php

namespace App\Services\User;

use App\Models\User\User;
use Illuminate\support\Arr;

class UserService
{
public static function getAll()
    {
        $User = User::all();

        if ($User->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay usuarios registrados",
                "data" => $User,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuarios obtenidos exitosamente",
            "data" => $User,
        ];
    }

    public function getById($id)
    {
        $User = User::find($id);

        if (!$User){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario obtenido exitosamente",
            "data" => $User,
        ];
    }

    public function create(array $data)
    {
        $User = User::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Usuario creado exitosamente",
            "data" => $User,
        ];
    }

    public function update(array $data, $id)
    {
        $User = User::find($id);

        if (!$User){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        $User->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado exitosamente",
            "data" => $User,
        ];
    }

    public function partialUpdate(array $data,$id)
    {
        $User = User::find($id);

        if (!$User){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        $User->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado parcialmente exitosamente",
            "data" => $User,
        ];
    }

    public function delete($id)
    {
        $User = User::find($id);

        if (!$User){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        $User->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario eliminado exitosamente",
        ];
    }
}
