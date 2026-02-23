<?php

namespace App\Http\Controllers\API\Gender;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Gender\StoreGenderRequest;
use App\Http\Requests\Gender\UpdateGenderRequest;
use App\Http\Requests\Gender\PartialUpdateGenderRequest;
use App\Http\Requests\Gender\ChangeStateGenderRequest;
use App\Http\Controllers\Controller;
use App\Services\Gender\GenderService;

/**
 * Controlador de Géneros.
 * Gestiona el catálogo de identidades de género para la caracterización de perfiles.
 */
class GenderController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de lógica para la entidad Gender.
     */
    public function __construct(GenderService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todos los géneros registrados (ej. Masculino, Femenino, No Binario).
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error'])
        {
            // Nota: Se recomienda normalizar a ResponseFormatter con "R" mayúscula.
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Obtiene la información de un género específico mediante su ID.
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
     * Crea una nueva opción de género en el sistema.
     */
    public function store(StoreGenderRequest $request)
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
     * Actualización total de los datos de un género (PUT).
     */
    public function update(UpdateGenderRequest $request, string $id)
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
     * Actualización parcial de un registro de género (PATCH).
     */
    public function partialUpdate(PartialUpdateGenderRequest $request, string $id)
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
     * Cambia el estado de activación del género (Habilitado/Deshabilitado).
     * Útil para retirar opciones sin eliminar datos históricos.
     */
    public function changeStatus(ChangeStateGenderRequest $request, string $id)
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
     * Elimina un registro de género. 
     * El servicio debe validar que no existan perfiles asociados antes de proceder.
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

    public function history(string $id)
    {
        $response = $this->service->history($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}