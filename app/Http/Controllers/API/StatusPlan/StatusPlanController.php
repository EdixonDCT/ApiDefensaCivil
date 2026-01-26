<?php

namespace App\Http\Controllers\API\StatusPlan;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\StatusPlan\StoreStatusPlanRequest;
use App\Http\Requests\StatusPlan\UpdateStatusPlanRequest;
use App\Http\Requests\StatusPlan\PartialUpdateStatusPlanRequest;
use App\Http\Requests\StatusPlan\ChangeStateStatusPlanRequest;
use App\Http\Controllers\Controller;
use App\Services\StatusPlan\StatusPlanService;

/**
 * Controlador de Estados del Plan.
 * Define las etapas por las que atraviesa un Plan Familiar desde su creación hasta su cierre.
 */
class StatusPlanController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de lógica para estados del plan.
     */
    public function __construct(StatusPlanService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todos los estados configurados para los planes.
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error'])
        {
            // Se normaliza a ResponseFormatter (PascalCase).
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Obtiene los detalles de un estado de plan específico.
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
     * Crea una nueva categoría de estado para los planes.
     */
    public function store(StoreStatusPlanRequest $request)
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
     * Actualización total de los datos de un estado de plan (PUT).
     */
    public function update(UpdateStatusPlanRequest $request, string $id)
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
     * Actualización parcial de un estado de plan (PATCH).
     */
    public function partialUpdate(PartialUpdateStatusPlanRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->service->partialUpdate($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []); 
    }

    /**
     * Cambia la disponibilidad (activo/inactivo) de un tipo de estado.
     */
    public function ChangeState(ChangeStateStatusPlanRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->service->changeState($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []); 
    }

    /**
     * Elimina un estado de la base de datos. 
     * El servicio debe impedir el borrado si hay planes familiares vinculados.
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