<?php

namespace App\Http\Controllers\Api\ActionPlanAction;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActionPlanAction\StoreActionPlanActionRequest;
use App\Http\Requests\ActionPlanAction\UpdateActionPlanActionRequest;
use App\Http\Requests\ActionPlanAction\PartialUpdateActionPlanActionRequest;
use App\Models\ActionPlanAction\ActionPlanAction;
use App\Services\ActionPlanAction\ActionPlanActionService;
// use App\Policies\AccessActionPlanActionPolicy;

class ActionPlanActionController extends Controller
{
    protected $service;

    public function __construct(ActionPlanActionService $service)
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
        $actionPlanAction = ActionPlanAction::find($id);

        if (!$actionPlanAction) {
            return ResponseFormatter::error('Registro no encontrado', 404);
        }

        // if (!(new AccessActionPlanActionPolicy())->access($actionPlanAction)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para ver este registro',
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

    public function store(StoreActionPlanActionRequest $request)
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

    public function update(UpdateActionPlanActionRequest $request, string $id)
    {
        $actionPlanAction = ActionPlanAction::find($id);

        if (!$actionPlanAction) {
            return ResponseFormatter::error('Registro no encontrado', 404);
        }

        // if (!(new AccessActionPlanActionPolicy())->access($actionPlanAction)) {
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

    public function partialUpdate(PartialUpdateActionPlanActionRequest $request, string $id)
    {
        $actionPlanAction = ActionPlanAction::find($id);

        if (!$actionPlanAction) {
            return ResponseFormatter::error('Registro no encontrado', 404);
        }

        // if (!(new AccessActionPlanActionPolicy())->access($actionPlanAction)) {
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
        $actionPlanAction = ActionPlanAction::find($id);

        if (!$actionPlanAction) {
            return ResponseFormatter::error('Registro no encontrado', 404);
        }

        // if (!(new AccessActionPlanActionPolicy())->access($actionPlanAction)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para eliminar este registro',
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
