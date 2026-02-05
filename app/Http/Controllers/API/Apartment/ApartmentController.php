<?php

namespace App\Http\Controllers\API\Apartment;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Apartment\StoreApartmentRequest;
use App\Http\Requests\Apartment\UpdateApartmentRequest;
use App\Http\Requests\Apartment\PartialUpdateApartmentRequest;
use App\Http\Requests\Apartment\ChangeStateApartmentRequest;
use App\Http\Controllers\Controller;
use App\Services\Apartment\ApartmentService;

/**
 * Controlador para la gestión de Apartamentos/Viviendas.
 * Centraliza las operaciones de los inmuebles vinculados a los planes familiares.
 */
class ApartmentController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de apartamentos.
     */
    public function __construct(ApartmentService $service)
    {
        $this->service = $service;
    }

    /**
     * Obtiene la lista de todos los apartamentos registrados.
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error'])
        {
            // Nota: Se corrigió la minúscula en 'responseFormatter' para mantener consistencia
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Muestra la información detallada de un apartamento específico.
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
     * Crea un nuevo registro de apartamento.
     * La validación se maneja de forma aislada en StoreApartmentRequest.
     */
    public function store(StoreApartmentRequest $request)
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
     * Actualización total del registro del apartamento (PUT).
     */
    public function update(UpdateApartmentRequest $request, string $id)
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
     * Actualización parcial de campos específicos del apartamento (PATCH).
     */
    public function partialUpdate(PartialUpdateApartmentRequest $request, string $id)
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
     * Cambia exclusivamente el estado operativo del apartamento (ej. Habitabilidad, Disponibilidad).
     */
    public function ChangeState(ChangeStateApartmentRequest $request, string $id)
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
     * Elimina el registro de un apartamento.
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