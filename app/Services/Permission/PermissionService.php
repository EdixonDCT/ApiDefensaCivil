<?php

namespace App\Services\Permission;

use App\Models\Permission;
use Illuminate\Support\Arr;

/**
 * Servicio para la gestión de permisos individuales del sistema.
 * Permite definir las capacidades atómicas de los usuarios.
 */
class PermissionService
{
    /**
     * Lista todos los permisos registrados en el sistema.
     */
    public static function getAll() 
    {
        $permissions = Permission::all();

        if (count($permissions) == 0) 
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay permisos registrados",
                "data" => $permissions
            ];

        return [
            "error" => false,
            "code" => 200,
            "message" => "Permisos obtenidos con éxito",
            "data" => $permissions
        ];
    }

    /**
     * Obtiene el detalle de un permiso específico.
     */
    public function getPermission($id) 
    {
        $permission = Permission::find($id);

        if (!$permission) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este permiso no existe",
            ];

        return [
            "error" => false,
            "code" => 200,
            "message" => "Permiso obtenido con éxito",
            "data" => $permission
        ];
    }

    /**
     * Crea un nuevo permiso.
     * @param array $data Incluye 'name', 'descripcion' y opcionalmente 'guard_name'.
     */
    public function createPermission(array $data) 
    {
        $permission = Permission::create([
            'name' => $data['name'],
            'descripcion' => $data['descripcion'] ?? null,
            'guard_name' => $data['guard_name'] ?? 'web', // Por defecto 'web' para Laravel Spatie
        ]);

        return [
            'error' => false,
            'code' => 201,
            'message' => 'Permiso creado con éxito',
            'data' => $permission // Recomendado incluir el objeto creado
        ];
    }

    /**
     * Actualiza los campos principales de un permiso.
     */
    public function updatePermission(array $data, $id) 
    {
        $permission = Permission::find($id);

        if (!$permission) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este permiso no existe",
            ];

        // Restringe la actualización solo a campos permitidos
        $permission->update(Arr::only($data, ['name', 'descripcion', 'guard_name']));

        return [
            "error" => false,
            "code" => 200,
            "message" => "Permiso actualizado con éxito",
        ];
    }

    /**
     * Actualización parcial para cambios rápidos de atributos.
     */
    public function partialUpdatePermission(array $entryData, $id) 
    {
        $permission = Permission::find($id);

        if (!$permission) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este permiso no existe",
            ];

        $permission->update($entryData);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Permiso actualizado con éxito",
        ];
    }

    /**
     * Elimina un permiso del sistema.
     * Nota: Esto revocará el permiso automáticamente de todos los roles/usuarios que lo tengan.
     */
    public function deletePermission($id) 
    {
        $permission = Permission::find($id);
        
        if (!$permission) 
            return [
                "error" => true,
                "code" => 404,
                "message" => "Este permiso no existe",
            ];

        $permission->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Permiso eliminado con éxito",
        ];
    }
}