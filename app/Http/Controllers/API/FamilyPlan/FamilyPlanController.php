<?php

namespace App\Http\Controllers\API\FamilyPlan;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\FamilyPlan\StoreFamilyPlanRequest;
use App\Http\Requests\FamilyPlan\UpdateFamilyPlanRequest;
use App\Http\Requests\FamilyPlan\PartialUpdateFamilyPlanRequest;
use App\Http\Requests\FamilyPlan\ChangeStatusFamilyPlanRequest;
use App\Http\Requests\FamilyPlan\GeoreFamilyPlanRequest;
use App\Http\Requests\FamilyPlan\IdentifyFamilyPlanRequest;
use App\Http\Controllers\Controller;
use App\Services\FamilyPlan\FamilyPlanService;

/**
 * Controlador de Planes Familiares.
 * Gestiona el ciclo de vida del diagnóstico familiar, desde la creación 
 * hasta la georreferenciación y el seguimiento de estados.
 */
class FamilyPlanController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de lógica para Planes Familiares.
     */
    public function __construct(FamilyPlanService $service)
    {
        $this->service = $service;
    }

    /**
     * Obtiene todos los planes familiares registrados.
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Muestra el detalle completo de un Plan Familiar específico.
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
     * Inicia la creación de un nuevo Plan Familiar.
     */
    public function store(StoreFamilyPlanRequest $request)
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
     * Actualización integral del Plan Familiar.
     */
    public function update(UpdateFamilyPlanRequest $request, string $id)
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
     * Actualización de campos específicos del Plan.
     */
    public function partialUpdate(PartialUpdateFamilyPlanRequest $request, string $id)
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
     * Cambia el estado del plan (ej. 'En Proceso', 'Completado', 'Validado').
     */
    public function changeStatus(ChangeStatusFamilyPlanRequest $request, string $id)
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
     * Registra las coordenadas y datos geográficos del hogar.
     */
    public function georeferencing(GeoreFamilyPlanRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->service->georeferencing($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []); 
    }

    /**
     * Registra los datos de identificación oficial del núcleo familiar dentro del plan.
     */
    public function identify(IdentifyFamilyPlanRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->service->identify($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []); 
    }

    /**
     * Elimina un Plan Familiar (usualmente restringido o bajo Soft Deletes).
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

    public function checkAccess(string $id)
    {
        $response = $this->service->checkAccess($id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function getFamilyPlanByUser()
    {
        $response = $this->service->getFamilyPlanByUser();

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? [],$response['paginate']);
    }
}