<?php

namespace App\Http\Controllers\API\Role;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\PartialUpdateRoleRequest;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Services\Role\RoleService;
use Illuminate\Http\Request;

/**
 * Controlador de Roles.
 * Gestiona los grupos de funciones y permisos asignables a los usuarios del sistema.
 */
class RoleController extends Controller
{
    protected $roleService;

    /**
     * Inyección del servicio de lógica para Roles.
     */
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Lista todos los roles configurados (ej. Admin, Supervisor, Voluntario).
     */
    public function index()
    {
        $response = $this->roleService->getAll();

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Obtiene los detalles de un rol específico, incluyendo usualmente sus permisos asociados.
     */
    public function show(string $id)
    {
        $response = $this->roleService->getRole($id);

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Crea un nuevo rol en el sistema.
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        $response = $this->roleService->createRole($data);

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Actualización integral de un rol (PUT).
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->roleService->updateRole($data, $id);

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Actualización parcial de un rol (PATCH).
     */
    public function partialUpdate(PartialUpdateRoleRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->roleService->partialUpdateRole($data, $id);

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Elimina un rol. El servicio debe validar que no haya usuarios 
     * activos vinculados a este rol antes de proceder.
     */
    public function destroy(string $id)
    {
        $response = $this->roleService->deleteRole($id);

        if ($response['error']) 
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}