<?php

namespace App\Http\Controllers\API\StateUser;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\StateUser\StoreStateUserRequest;
use App\Http\Requests\StateUser\UpdateStateUserRequest;
use App\Http\Controllers\Controller;
use App\Services\StateUser\StateUserService;

/**
 * Controlador de Estados de Usuario.
 * Administra los posibles estados que puede tener una cuenta de usuario en la plataforma.
 */
class stateUserController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de lógica para estados de usuario.
     */
    public function __construct(StateUserService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todos los estados de usuario disponibles.
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error'])
        {
            // Nota: Se recomienda normalizar a ResponseFormatter (PascalCase).
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Muestra la información de un estado específico por su ID.
     */
    public function show(string $id)
    {
        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Crea una nueva opción de estado para los usuarios.
     */
    public function store(StoreStateUserRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->create($data);

        if ($response['error'])
        {    
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Actualiza un estado de usuario existente.
     */
    public function update(UpdateStateUserRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->service->update($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Elimina un estado de usuario.
     * El servicio debe validar que no existan usuarios vinculados a este estado.
     */
    public function destroy(string $id)
    {
        $response = $this->service->delete($id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}