<?php

namespace App\Services\Role;

use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

/**
 * Servicio para la gestión de Roles de usuario.
 * Actúa como contenedor de permisos para facilitar la administración de accesos.
 */
class RoleService
{
    /**
     * Obtiene todos los roles definidos en el sistema.
     * @return array
     */
    public static function getAll()
    {
        $roles = Role::all();

        if (count($roles) == 0) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay roles registrados",
                "data" => $roles,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Roles obtenidos con éxito",
            "data" => $roles,
        ];
    }

    /**
     * Busca un rol específico por su identificador.
     * @param int|string $id
     * @return array
     */
    public function getRole($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este rol no existe",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Rol obtenido con éxito",
            "data" => $role,
        ];
    }

    /**
     * Crea un nuevo rol en la base de datos.
     * @param array $data Debe contener al menos el 'name'.
     * @return array
     */
    public function createRole(array $data)
    {
        Role::create([
            'name' => $data['name'],
            'guard_name' => $data['guard_name'] ?? 'web', // Spatie requiere un guard_name
        ]);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Rol creado con éxito",
        ];
    }

    /**
     * Actualización completa del nombre del rol.
     */
    public function updateRole(array $data, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este rol no existe",
            ];
        }

        $role->update(Arr::only($data, ['name']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Rol actualizado con éxito",
        ];
    }

    /**
     * Actualización parcial del rol.
     */
    public function partialUpdateRole(array $data, $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este rol no existe",
            ];
        }

        $role->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Rol actualizado con éxito",
        ];
    }

    /**
     * Elimina un rol.
     * Importante: Esto desvincula a todos los usuarios que posean este rol.
     */
    public function deleteRole($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este rol no existe",
            ];
        }

        $role->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Rol eliminado con éxito",
        ];
    }
}