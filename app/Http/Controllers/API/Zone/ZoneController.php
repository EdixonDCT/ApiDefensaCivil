<?php

namespace App\Http\Controllers\API\Zone;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Zone\StoreZoneRequest;
use App\Http\Requests\Zone\UpdateZoneRequest;
use App\Http\Controllers\Controller;
use App\Services\Zone\ZoneService;

/**
 * Controlador de Zonas.
 * Gestiona la delimitación geográfica de alto nivel donde operan las seccionales 
 * y se distribuyen los sectores.
 */
class ZoneController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de lógica para la gestión de Zonas.
     */
    public function __construct(ZoneService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todas las zonas registradas en el sistema.
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error'])
        {
            // Nota: Normalizado a PascalCase para evitar fallos en entornos Linux.
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Obtiene los detalles de una zona específica.
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
     * Registra una nueva zona geográfica.
     */
    public function store(StoreZoneRequest $request)
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
     * Actualiza la información de una zona existente (PUT).
     */
    public function update(UpdateZoneRequest $request, string $id)
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
     * Elimina una zona. 
     * El servicio debe validar que no existan dependencias (como Sectores o Viviendas) 
     * activas vinculadas a esta zona.
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