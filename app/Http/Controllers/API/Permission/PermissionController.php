<?php

namespace App\Http\Controllers\API\Permission;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PartialUpdatePermissionRequest;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Services\Permission\PermissionService;
use Illuminate\Http\Request;

/**
 * Controlador de Permisos.
 * Gestiona el catálogo de capacidades atómicas del sistema para el control de acceso (RBAC).
 */
class PermissionController extends Controller
{
    protected $permissionService;

    /**
     * Inyección del servicio de permisos.
     */
    public function __construct(PermissionService $permissionService) 
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Lista todos los permisos registrados en el sistema.
     */
    public function index()
    {
        $response = $this->permissionService->getAll();

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Obtiene los detalles de un permiso específico.
     */
    public function show(string $id)
    {
        $response = $this->permissionService->getPermission($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Registra una nueva capacidad o permiso.
     */
    public function store(StorePermissionRequest $request)
    {
        $data = $request->validated();
        $response = $this->permissionService->createPermission($data);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Actualización total de un permiso (PUT).
     */
    public function update(UpdatePermissionRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->permissionService->updatePermission($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Actualización parcial de un permiso (PATCH), útil para editar solo el nombre o la descripción.
     */
    public function partialUpdate(PartialUpdatePermissionRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->permissionService->partialUpdatePermission($data, $id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Elimina un permiso del sistema. 
     * Nota: Esto suele tener un impacto directo en los roles que lo poseen.
     */
    public function destroy(string $id)
    {
        $response = $this->permissionService->deletePermission($id);

        if($response['error'])
            return ResponseFormatter::error($response['message'], $response['code']);

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}