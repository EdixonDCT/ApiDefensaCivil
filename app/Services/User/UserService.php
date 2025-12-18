<?php

namespace App\Services\User;

use App\Models\User\User;
use Illuminate\support\Arr;

class UserService
{
public static function getAll()
    {
        $user = User::all();

        if ($user->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay usuarios registrados",
                "data" => $user,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuarios obtenidos exitosamente",
            "data" => $user,
        ];
    }

    public function getById($id)
    {
        $user = User::find($id);

        if (!$user){
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
            "data" => $user,
        ];
    }

    public function create(array $data)
    {
        $user = User::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Usuario creado exitosamente",
            "data" => $user,
        ];
    }

    public function update(array $data, $id)
    {
        $user = User::find($id);

        if (!$user){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        $user->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado exitosamente",
            "data" => $user,
        ];
    }

    public function partialUpdate(array $data,$id)
    {
        $user = User::find($id);

        if (!$user){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        $user->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado parcialmente exitosamente",
            "data" => $user,
        ];
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        if ($user->profile->count()) {
        return [
            "error" => true,
            "code" => 409,
            "message" => "No se puede eliminar el usuario porque tiene un perfil relacionado",
            ];
        }

        $user->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario eliminado exitosamente",
        ];
    }
}
