<?php

namespace App\Services\StateUser;

use App\Models\StateUser\StateUser;
use Illuminate\support\Arr;

/**
 * Servicio para la gestión de los estados de usuario.
 * Define la disponibilidad operativa de las cuentas en el sistema.
 */
class StateUserService
{
    /**
     * Obtiene todos los estados de usuario disponibles.
     */
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

    /**
     * Obtiene un estado de usuario específico por ID.
     */
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

    /**
     * Crea una nueva categoría de estado de usuario.
     */
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

    /**
     * Actualiza el nombre o descripción de un estado.
     */
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

    /**
     * Elimina un estado de usuario siempre que no haya usuarios usándolo.
     * Crucial para mantener la integridad de las cuentas existentes.
     */
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
        
        // Validación de relación hasMany con el modelo User
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