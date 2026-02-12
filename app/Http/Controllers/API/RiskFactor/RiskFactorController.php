<?php

namespace App\Http\Controllers\API\RiskFactor;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\RiskFactor\StoreRiskFactorRequest;
use App\Http\Requests\RiskFactor\UpdateRiskFactorRequest;
use App\Http\Requests\RiskFactor\PartialUpdateRiskFactorRequest;
use App\Models\RiskFactor\RiskFactor;
use App\Services\RiskFactor\RiskFactorService;
use App\Policies\AccessRiskFactorPolicy;
use App\Policies\AccessPlanPolicy;

class RiskFactorController extends Controller
{
    protected $service;

    public function __construct(RiskFactorService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todos los factores de riesgo
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Muestra un factor de riesgo específico
     */
    public function show(string $id)
    {
        $factor = RiskFactor::find($id);

        if (!$factor) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessRiskFactorPolicy())->access($factor)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para ver este factor de riesgo',
        //         403
        //     );
        // }

        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    // Obtener factores de riesgo por plan familiar (paginado)

    public function getForPlan(string $plan_id)
    {
        // Validación de acceso al plan
        if (!(new AccessPlanPolicy())->access($plan_id)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para acceder a este plan',
                403
            );
        }

        $response = $this->service->getByFamilyPlan($plan_id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Crea un nuevo factor de riesgo
     */
    public function store(StoreRiskFactorRequest $request)
    {
        // Si necesitas validar acceso a algún plan:
        if (!(new AccessPlanPolicy())->access($request->family_plan_id)) {
            return ResponseFormatter::error('No tiene autorización para este plan', 403);
        }

        $data = $request->validated();
        $response = $this->service->create($data);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Actualización completa (PUT)
     */
    public function update(UpdateRiskFactorRequest $request, string $id)
    {
        $factor = RiskFactor::find($id);

        if (!$factor) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessRiskFactorPolicy())->access($factor)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar este factor de riesgo',
        //         403
        //     );
        // }

        $response = $this->service->update($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Actualización parcial (PATCH)
     */
    public function partialUpdate(PartialUpdateRiskFactorRequest $request, string $id)
    {
        $factor = RiskFactor::find($id);

        if (!$factor) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessRiskFactorPolicy())->access($factor)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar este factor de riesgo',
        //         403
        //     );
        // }

        $response = $this->service->partialUpdate($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    /**
     * Elimina un factor de riesgo
     */
    public function destroy(string $id)
    {
        $factor = RiskFactor::find($id);

        if (!$factor) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessRiskFactorPolicy())->access($factor)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para eliminar este factor de riesgo',
        //         403
        //     );
        // }

        $response = $this->service->delete($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
