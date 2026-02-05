<?php

namespace App\Http\Controllers\API\VulnerableTest;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\VulnerableTest\VulnerableTestService;
use App\Http\Requests\VulnerableTest\StoreVulnerableTestRequest;

/**
 * Controlador de Tests de Vulnerabilidad.
 * Gestiona la ejecución y el registro de evaluaciones socioeconómicas aplicadas 
 * a los planes familiares para determinar niveles de prioridad e intervención.
 */
class VulnerableTestController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio para la gestión de tests de vulnerabilidad.
     */
    public function __construct(VulnerableTestService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Lista todos los tests realizados en el sistema.
     */
    public function index()
    {
        $response = $this->service->index();

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Obtiene los resultados de los tests asociados a un Plan Familiar específico.
     * Útil para ver el diagnóstico inicial de una familia.
     */
    public function show(string $familyPlan_id)
    {
        $response = $this->service->show($familyPlan_id);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Guarda los resultados de un nuevo test de vulnerabilidad.
     * Este método suele procesar un conjunto de preguntas y respuestas en bloque.
     */
    public function store(StoreVulnerableTestRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->create($data);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Elimina todos los registros de tests asociados a un plan familiar.
     * Generalmente se usa para reiniciar una evaluación mal aplicada.
     */
    public function destroy(string $familyPlan_id)
    {
        $response = $this->service->delete($familyPlan_id);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['deleted_rows'] ?? []
        );
    }
}