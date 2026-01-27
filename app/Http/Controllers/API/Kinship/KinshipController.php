<?php

namespace App\Http\Controllers\API\Kinship;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\Kinship\KinshipService;
use App\Http\Requests\Kinship\StoreKinshipRequest;
use App\Http\Requests\Kinship\UpdateKinshipRequest;

/**
 * Controlador de Parentescos.
 * Gestiona el catálogo de parentescos del sistema.
 */
class KinshipController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de lógica para parentescos.
     */
    public function __construct(KinshipService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todos los parentescos registrados.
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
     * Obtiene un parentesco específico por su ID.
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
     * Registra un nuevo parentesco.
     */
    public function store(StoreKinshipRequest $request)
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
     * Actualiza un parentesco existente (PUT).
     */
    public function update(UpdateKinshipRequest $request, string $id)
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
     * Elimina un parentesco.
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
