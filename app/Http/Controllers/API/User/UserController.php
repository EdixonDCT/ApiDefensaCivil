<?php

namespace App\Http\Controllers\API\User;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\PartialUpdateUserRequest;
use App\Http\Requests\User\ChangeStateUserRequest;
use App\Http\Controllers\Controller;
use App\Services\User\UserService;

/**
 * Controlador de Usuarios.
 * Gestiona las cuentas de acceso al sistema, vinculando credenciales, roles y estados.
 */
class UserController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de lógica de negocio para usuarios.
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Obtiene el listado de todos los usuarios registrados.
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error'])
        {
            // Corregido a ResponseFormatter (PascalCase) para consistencia.
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Muestra la información de una cuenta de usuario específica.
     */
    public function show(string $id)
    {
        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function getRequests()
    {
        $response = $this->service->getRequests();

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? [],$response['paginate']);
    }

    /**
     * Registra un nuevo usuario en la plataforma.
     * Habitualmente gestiona el hashing de contraseñas y asignación inicial de roles.
     */
    public function store(StoreUserRequest $request)
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
     * Actualización integral del usuario (PUT).
     */
    public function update(UpdateUserRequest $request, string $id)
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
     * Actualización parcial del usuario (PATCH). 
     * Útil para cambiar solo la contraseña o el estado sin afectar otros campos.
     */
    public function partialUpdate(PartialUpdateUserRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->service->partialUpdate($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }
        
        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []); 
    }

    public function ChangeStatus(ChangeStateUserRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->service->changeStatus($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []); 
    }

    /**
     * Elimina una cuenta de usuario.
     * Nota: Se recomienda implementar "Soft Deletes" para mantener integridad referencial en el historial.
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