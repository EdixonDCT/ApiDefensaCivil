<?php

namespace App\Http\Controllers\API\ConditionType;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConditionType\StoreConditionTypeRequest;
use App\Http\Requests\ConditionType\UpdateConditionTypeRequest;
use App\Services\ConditionType\ConditionTypeService;

/**
 * Controlador para la gestión de Tipos de Condición.
 *
 * Centraliza las operaciones CRUD relacionadas
 * con los tipos de condición del sistema.
 */
class ConditionTypeController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de tipos de condición.
     *
     * @param ConditionTypeService $service
     */
    public function __construct(ConditionTypeService $service)
    {
        $this->service = $service;
    }

    /**
     * Obtiene la lista de todos los tipos de condición registrados.
     *
     * @return \Illuminate\Http\JsonResponse
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
     * Muestra la información de un tipo de condición específico.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
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
     * Crea un nuevo tipo de condición.
     *
     * La validación se maneja en StoreConditionTypeRequest.
     *
     * @param StoreConditionTypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreConditionTypeRequest $request)
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
     * Actualización total de un tipo de condición (PUT).
     *
     * @param UpdateConditionTypeRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateConditionTypeRequest $request, string $id)
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
     * Elimina un tipo de condición.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $response = $this->service->delete($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code']
        );
    }
}
