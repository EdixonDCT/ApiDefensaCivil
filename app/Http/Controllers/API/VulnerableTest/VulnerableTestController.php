<?php

namespace App\Http\Controllers\API\VulnerableTest;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\VulnerableTest\VulnerableTestService;

use App\Http\Requests\VulnerableTest\StoreVulnerableTestRequest;

class VulnerableTestController extends Controller
{
    protected $service;

    public function __construct(VulnerableTestService $service)
    {
        $this->service = $service;
    }
    
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
     * Elimina todos los tests vulnerables asociados a un family_plan
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
