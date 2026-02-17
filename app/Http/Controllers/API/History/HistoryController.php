<?php

namespace App\Http\Controllers\API\History;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\History\StoreHistoryRequest;
use App\Http\Requests\History\UpdateHistoryRequest;
use App\Http\Requests\History\PartialUpdateHistoryRequest;
use App\Services\History\HistoryService;

/**
 * Controlador de Historial y Seguimiento.
 * Gestiona el registro de actividades y el control de acceso a los planes familiares.
 */
class HistoryController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de gestión de historial.
     */
    public function __construct(HistoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Obtiene el listado completo de registros históricos en el sistema.
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
     * Obtiene un registro de historial específico por ID.
     */
    public function show($id)
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
     * Crea un nuevo hito o registro en el historial de intervención.
     */
    public function store(StoreHistoryRequest $request)
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
     * Actualización total de un registro de historial.
     */
    public function update(UpdateHistoryRequest $request, $id)
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
     * Actualización parcial de datos históricos.
     */
    public function partialUpdate(PartialUpdateHistoryRequest $request, $id)
    {
        $data = $request->validated();
        $response = $this->service->partialUpdate($data, $id);

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
     * Elimina un registro del historial.
     */
    public function destroy($id)
    {
        $response = $this->service->delete($id);

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
     * Filtra las acciones o intervenciones realizadas específicamente por voluntarios.
     */
    public function actionsByVoluntario()
    {
        $response = $this->service->getActionsByVoluntario();

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? [],
            $response['paginate']
        );
    }

    /**
     * Obtiene el reporte de acciones supervisadas o realizadas por personal de supervisión.
     */
    public function actionsBySupervisor()
    {
        $response = $this->service->getActionsBySupervisor();

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }
}