<?php

namespace App\Http\Controllers\Api\ActionPlan;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActionPlan\StoreActionPlanRequest;
use App\Http\Requests\ActionPlan\UpdateActionPlanRequest;
use App\Http\Requests\ActionPlan\PartialUpdateActionPlanRequest;
use App\Models\ActionPlan\ActionPlan;
use App\Services\ActionPlan\ActionPlanService;
use App\Policies\AccessActionPlanPolicy;

class ActionPlanController extends Controller
{
    protected $service;
    
    public function __construct(ActionPlanService $service)
    {
        $this->service = $service;
    }

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

    public function show(string $id)
    {
        $ActionPlan = ActionPlan::find($id);

        if (!$ActionPlan) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessActionPlanPolicy())->access($ActionPlan)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar este registro',
        //         403
        //     );
        // }

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

    public function store(StoreActionPlanRequest $request)
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

    public function update(UpdateActionPlanRequest $request, string $id)
    {
        $ActionPlan = ActionPlan::find($id);

        if (!$ActionPlan) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessActionPlanPolicy())->access($ActionPlan)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar este registro',
        //         403
        //     );
        // }

        $response = $this->service->update($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function partialUpdate(PartialUpdateActionPlanRequest $request, string $id)
    {
        $ActionPlan = ActionPlan::find($id);

        if (!$ActionPlan) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessActionPlanPolicy())->access($ActionPlan)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar este registro',
        //         403
        //     );
        // }

        $response = $this->service->partialUpdate($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function destroy(string $id)
    {
        $ActionPlan = ActionPlan::find($id);

        if (!$ActionPlan) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessActionPlanPolicy())->access($ActionPlan)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar este registro',
        //         403
        //     );
        // }

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
}
