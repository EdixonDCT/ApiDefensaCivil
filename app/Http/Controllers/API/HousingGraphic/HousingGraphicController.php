<?php

namespace App\Http\Controllers\API\HousingGraphic;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\HousingGraphic\StoreHousingGraphicRequest;
use App\Http\Requests\HousingGraphic\UpdateHousingGraphicDescriptionRequest;
use App\Http\Controllers\Controller;
use App\Services\HousingGraphic\HousingGraphicService;

/**
 * Controlador de Información de Vivienda.
 * Gestiona los datos técnicos y socioeconómicos del inmueble donde reside la familia.
 */
class HousingGraphicController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de lógica para Información de Vivienda.
     */
    public function __construct(HousingGraphicService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todos los registros de información de vivienda.
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error'])
        {
            // Nota: Se recomienda normalizar a PascalCase (ResponseFormatter).
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Obtiene los detalles de la vivienda para un registro específico.
     */
    public function show(string $id)
    {
        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function getByFamilyPlan(string $plan_id)
    {
        $response = $this->service->getByFamilyPlan($plan_id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? [], $response['paginate']);
    }

    /**
     * Registra la información técnica de una vivienda.
     * Habitualmente vincula datos como tipo de piso, techo y acceso a servicios.
     */
    public function store(StoreHousingGraphicRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->create($data);

        if ($response['error'])
        {    
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function updateDescription(UpdateHousingGraphicDescriptionRequest $request,string $id)
    {
        $data = $request->validated();

        $response = $this->service->partialUpdate($data,$id);

        if ($response['error'])
        {    
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Elimina un registro de información de vivienda.
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