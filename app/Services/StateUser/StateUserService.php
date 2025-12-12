<?php

namespace App\Services\StateUser;

use App\Models\StateUser\StateUser;
use Illuminate\support\Arr;

class StateUserService
{
    public static function getAll()
    {
        $stateUsers = StateUser::all();

        if ($stateUsers->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay estados de usuarios registrados",
                "data" => $stateUsers,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estados de usuarios obtenidos exitosamente",
            "data" => $stateUsers,
        ];
    }

    public function getById($id)
    {
        $stateUser = StateUser::find($id);

        if (!$stateUser){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Estado de usuario no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado de usuario obtenido exitosamente",
            "data" => $stateUser,
        ];
    }

    public function create(array $data)
    {
        $stateUser = StateUser::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Estado de usuario creado exitosamente",
            "data" => $stateUser,
        ];
    }

    public function update(array $data, $id)
    {
        $stateUser = StateUser::find($id);

        if (!$stateUser){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Estado de usuario no encontrado",
            ];
        }

        $stateUser->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado de usuario actualizado exitosamente",
            "data" => $stateUser,
        ];
    }

    public function delete($id)
    {
        $stateUser = StateUser::find($id);

        if (!$stateUser){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Estado de usuario no encontrado",
            ];
        }
        
        if ($stateUser->user->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar el estado de usuario porque tiene registros relacionados",
            ];
        }

        $stateUser->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Estado de usuario eliminado exitosamente",
        ];
    }
}
