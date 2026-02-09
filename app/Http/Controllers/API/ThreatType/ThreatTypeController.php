<?php

namespace App\Http\Controllers\Api\ThreatType;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ThreatType\StoreThreatTypeRequest;
use App\Http\Requests\ThreatType\UpdateThreatTypeRequest;
use App\Http\Requests\ThreatType\PartialUpdateThreatTypeRequest;
use App\Models\ThreatType\ThreatType;
use App\Policies\AccessThreatTypePolicy;
use App\Services\ThreatType\ThreatTypeService;

class ThreatTypeController extends Controller
{
    protected $service;

    public function __construct(ThreatTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function show(string $id)
    {
        $threatType = ThreatType::find($id);

        if (!$threatType) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessThreatTypePolicy())->access($threatType)) {
        //     return ResponseFormatter::error(
        //         "Usted no tiene autorización para ver este tipo de amenaza",
        //         403
        //     );
        // }

        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function store(StoreThreatTypeRequest $request)
    {
        $data = $request->validated();

        // Si deseas validar acceso a un plan o usuario, se puede agregar aquí
        // if (!(new AccessPlanPolicy())->access($data['plan_id'])) { ... }

        $response = $this->service->create($data);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateThreatTypeRequest $request, string $id)
    {
        $threatType = ThreatType::find($id);

        if (!$threatType) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessThreatTypePolicy())->access($threatType)) {
        //     return ResponseFormatter::error(
        //         "Usted no tiene autorización para modificar este tipo de amenaza",
        //         403
        //     );
        // }

        $response = $this->service->update($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateThreatTypeRequest $request, string $id)
    {
        $threatType = ThreatType::find($id);

        if (!$threatType) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessThreatTypePolicy())->access($threatType)) {
        //     return ResponseFormatter::error(
        //         "Usted no tiene autorización para modificar este tipo de amenaza",
        //         403
        //     );
        // }

        $response = $this->service->partialUpdate($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function destroy(string $id)
    {
        $threatType = ThreatType::find($id);

        if (!$threatType) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessThreatTypePolicy())->access($threatType)) {
        //     return ResponseFormatter::error(
        //         "Usted no tiene autorización para eliminar este tipo de amenaza",
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
