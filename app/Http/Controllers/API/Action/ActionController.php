<?php

namespace App\Http\Controllers\API\Action;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Action\StoreActionRequest;
use App\Http\Requests\Action\UpdateActionRequest;
use App\Services\Action\ActionService;

/**
 * Controlador para la gestión de Acciones.
 * Maneja las peticiones HTTP y delega la lógica de negocio al ActionService.
 */
class ActionController extends Controller
{
    protected $service;

    /**
     * Inyección de dependencia del servicio de acciones.
     */
    public function __construct(ActionService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todas las acciones registradas.
     * Retorna una respuesta exitosa incluso si la lista está vacía (siguiendo la lógica del servicio).
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
     * Obtiene los detalles de una acción específica por su UUID o ID.
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
     * Registra una nueva acción en el sistema.
     * Utiliza StoreActionRequest para validar los datos antes de entrar al método.
     */
    public function store(StoreActionRequest $request)
    {
        // Solo datos validados por el FormRequest
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
     * Actualiza una acción existente.
     * Valida los datos con UpdateActionRequest para permitir actualizaciones parciales o totales.
     */
    public function update(UpdateActionRequest $request, string $id)
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
     * Elimina una acción del sistema.
     * El servicio se encarga de verificar si existen restricciones de integridad antes de borrar.
     */
    public function destroy(string $id)
    {
        $response = $this->service->delete($id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'], 
            $response['code'], 
            $response['data'] ?? []
        );
    }
}