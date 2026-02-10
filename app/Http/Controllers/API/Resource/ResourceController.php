<?php

namespace App\Http\Controllers\Api\Resource;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\StoreResourceRequest;
use App\Http\Requests\Resource\UpdateResourceRequest;
use App\Http\Requests\Resource\PartialUpdateResourceRequest;
use App\Models\Resource\Resource;
use App\Policies\AccessPlanPolicy;
use App\Policies\AccessResourcePolicy;
use App\Services\Resource\ResourceService;

class ResourceController extends Controller
{
    protected $service;

    public function __construct(ResourceService $service)
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
        $resource = Resource::find($id);

        if (!$resource) {
            return ResponseFormatter::error("Record not found", 404);
        }

        // if (!(new AccessResourcePolicy())->access($resource)) {
        //     return ResponseFormatter::error(
        //         'You are not authorized to access this resource',
        //         403
        //     );
        // }

        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function getResourcesForPlan(string $plan_id)
    {
        // if (!(new AccessPlanPolicy())->access($plan_id)) {
        //     return ResponseFormatter::error(
        //         'You are not authorized to access this plan',
        //         403
        //     );
        // }

        $response = $this->service->getResourcesForPlan($plan_id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function store(UpdateResourceRequest $request)
    {
        // if (!(new AccessPlanPolicy())->access($request->plan_id)) {
        //     return ResponseFormatter::error(
        //         'You are not authorized to add resources to this plan',
        //         403
        //     );
        // }

        $data = $request->validated();
        $response = $this->service->create($data);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateResourceRequest $request, string $id)
    {
        $resource = Resource::find($id);

        if (!$resource) {
            return ResponseFormatter::error("Record not found", 404);
        }

        // if (!(new AccessResourcePolicy())->access($resource)) {
        //     return ResponseFormatter::error(
        //         'You are not authorized to update this resource',
        //         403
        //     );
        // }

        $response = $this->service->update($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateResourceRequest $request, string $id)
    {
        $resource = Resource::find($id);

        if (!$resource) {
            return ResponseFormatter::error("Record not found", 404);
        }

        // if (!(new AccessResourcePolicy())->access($resource)) {
        //     return ResponseFormatter::error(
        //         'You are not authorized to update this resource',
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
        $resource = Resource::find($id);

        if (!$resource) {
            return ResponseFormatter::error("Record not found", 404);
        }

        // if (!(new AccessResourcePolicy())->access($resource)) {
        //     return ResponseFormatter::error(
        //         'You are not authorized to delete this resource',
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
