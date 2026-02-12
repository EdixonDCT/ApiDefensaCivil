<?php

namespace App\Http\Controllers\Api\AvailableResource;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\AvailableResource\StoreAvailableResourceRequest;
use App\Http\Requests\AvailableResource\UpdateAvailableResourceRequest;
use App\Http\Requests\AvailableResource\PartialUpdateAvailableResourceRequest;
use App\Models\AvailableResource\AvailableResource;
use App\Policies\AccessAvailableResourcePolicy;
use App\Policies\AccessFamilyPlanPolicy;
use App\Services\AvailableResource\AvailableResourceService;

class AvailableResourceController extends Controller
{
    protected $service;

    public function __construct(AvailableResourceService $service)
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
        $availableResource = AvailableResource::find($id);

        if (!$availableResource) {
            return ResponseFormatter::error("Recurso no encontrado", 404);
        }

        // if (!(new AccessAvailableResourcePolicy())->access($availableResource)) {
        //     return ResponseFormatter::error(
        //         'No estás autorizado para ver este recurso',
        //         403
        //     );
        // }

        return ResponseFormatter::success("Recurso obtenido correctamente", 200, $availableResource);
    }

    public function store(StoreAvailableResourceRequest $request)
    {
        // if (!(new AccessFamilyPlanPolicy())->access($request->family_plan_id)) {
        //     return ResponseFormatter::error(
        //         'No estás autorizado para agregar recursos a este plan',
        //         403
        //     );
        // }

        $response = $this->service->create($request->validated());

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateAvailableResourceRequest $request, string $id)
    {
        $availableResource = AvailableResource::find($id);

        if (!$availableResource) {
            return ResponseFormatter::error("Recurso no encontrado", 404);
        }

        // if (!(new AccessAvailableResourcePolicy())->access($availableResource)) {
        //     return ResponseFormatter::error(
        //         'No estás autorizado para actualizar este recurso',
        //         403
        //     );
        // }

        $response = $this->service->update($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateAvailableResourceRequest $request, string $id)
    {
        $availableResource = AvailableResource::find($id);

        if (!$availableResource) {
            return ResponseFormatter::error("Recurso no encontrado", 404);
        }

        // if (!(new AccessAvailableResourcePolicy())->access($availableResource)) {
        //     return ResponseFormatter::error(
        //         'No estás autorizado para actualizar este recurso',
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
        $availableResource = AvailableResource::find($id);

        if (!$availableResource) {
            return ResponseFormatter::error("Recurso no encontrado", 404);
        }

        // if (!(new AccessAvailableResourcePolicy())->access($availableResource)) {
        //     return ResponseFormatter::error(
        //         'No estás autorizado para eliminar este recurso',
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
