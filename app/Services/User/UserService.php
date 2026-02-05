<?php

namespace App\Services\User;

use App\Models\User\User;
use Illuminate\support\Arr;

/**
 * Servicio para la gestión de cuentas de usuario.
 * Maneja las credenciales y la vinculación con la tabla de perfiles.
 */
class UserService
{
    /**
     * Obtiene la lista de todos los usuarios (credenciales).
     */
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

    /**
     * Obtiene un usuario específico por su ID.
     */
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

    /**
     * Crea un nuevo usuario.
     * Importante: Los datos deben incluir email, password (hasheado) y state_user_id.
     */
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

    /**
     * Actualización total de la cuenta de usuario.
     */
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

    /**
     * Actualización parcial (ej. cambio de contraseña o cambio de estado).
     */
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

    /**
     * Elimina el usuario validando que no tenga un perfil asociado.
     * Si el perfil existe, se recomienda eliminar primero el perfil o usar soft deletes.
     */
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

        // Validación de integridad: Un usuario no puede ser borrado si tiene un perfil humano activo
        if ($user->profile()->exists()) {
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