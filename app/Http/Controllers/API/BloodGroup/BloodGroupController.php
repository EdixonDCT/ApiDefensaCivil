<?php

namespace App\Http\Controllers\API\BloodGroup;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\BloodGroup\BloodGroupService;
use App\Http\Requests\BloodGroup\StoreBloodGroupRequest;
use App\Http\Requests\BloodGroup\UpdateBloodGroupRequest;

/**
 * Controlador de Grupos Sanguíneos.
 * Gestiona el catálogo de grupos sanguíneos del sistema.
 */
class BloodGroupController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de lógica para grupos sanguíneos.
     */
    public function __construct(BloodGroupService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todos los grupos sanguíneos registrados.
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Obtiene un grupo sanguíneo específico por su ID.
     */
    public function show(string $id)
    {
        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Registra un nuevo grupo sanguíneo.
     */
    public function store(StoreBloodGroupRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->create($data);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Actualiza un grupo sanguíneo existente (PUT).
     */
    public function update(UpdateBloodGroupRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->service->update($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Elimina un grupo sanguíneo.
     * El servicio valida que no esté siendo usado por usuarios.
     */
    public function destroy(string $id)
    {
        $response = $this->service->delete($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }
}
