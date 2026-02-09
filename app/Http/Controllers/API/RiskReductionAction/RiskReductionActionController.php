<?php

namespace App\Http\Controllers\API\RiskReductionAction;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\RiskReductionAction\StoreRiskReductionActionRequest;
use App\Http\Requests\RiskReductionAction\UpdateRiskReductionActionRequest;
use App\Http\Requests\RiskReductionAction\PartialUpdateRiskReductionActionRequest;
use App\Models\RiskReductionAction\RiskReductionAction;
use App\Services\RiskReductionAction\RiskReductionActionService;
use App\Policies\AccessRiskReductionActionPolicy;

class RiskReductionActionController extends Controller
{
    protected $service;

    public function __construct(RiskReductionActionService $service)
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
        $action = RiskReductionAction::find($id);

        if (!$action) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessRiskReductionActionPolicy())->access($action)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para ver esta acción',
        //         403
        //     );
        // }

        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function store(StoreRiskReductionActionRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->create($data);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateRiskReductionActionRequest $request, string $id)
    {
        $action = RiskReductionAction::find($id);

        if (!$action) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessRiskReductionActionPolicy())->access($action)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar esta acción',
        //         403
        //     );
        // }

        $response = $this->service->update($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateRiskReductionActionRequest $request, string $id)
    {
        $action = RiskReductionAction::find($id);

        if (!$action) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessRiskReductionActionPolicy())->access($action)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar esta acción',
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
        $action = RiskReductionAction::find($id);

        if (!$action) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessRiskReductionActionPolicy())->access($action)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para eliminar esta acción',
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
