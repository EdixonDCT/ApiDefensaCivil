<?php

namespace App\Http\Controllers\Api\ActionType;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActionType\StoreActionTypeRequest;
use App\Http\Requests\ActionType\UpdateActionTypeRequest;
use App\Http\Requests\ActionType\PartialUpdateActionTypeRequest;
use App\Models\ActionType\ActionType;
use App\Policies\AccessActionTypePolicy;
use App\Services\ActionType\ActionTypeService;

class ActionTypeController extends Controller
{
    protected $service;

    public function __construct(ActionTypeService  $service)
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
        $actionType = ActionType::find($id);

        if (!$actionType) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessActionTypePolicy())->access($actionType)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para acceder a este registro',
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

    public function store(StoreActionTypeRequest $request)
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

    public function update(UpdateActionTypeRequest $request, string $id)
    {
        $actionType = ActionType::find($id);

        if (!$actionType) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessActionTypePolicy())->access($actionType)) {
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

    public function partialUpdate(PartialUpdateActionTypeRequest $request, string $id)
    {
        $actionType = ActionType::find($id);

        if (!$actionType) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessActionTypePolicy())->access($actionType)) {
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
        $actionType = ActionType::find($id);

        if (!$actionType) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        // if (!(new AccessActionTypePolicy())->access($actionType)) {
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
