<?php

namespace App\Http\Controllers\API\Sectional;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Sectional\StoreSectionalRequest;
use App\Http\Requests\Sectional\UpdateSectionalRequest;
use App\Http\Requests\Sectional\PartialUpdateSectionalRequest;
use App\Http\Requests\Sectional\ChangeStateSectionalRequest;
use App\Http\Controllers\Controller;
use App\Services\Sectional\SectionalService;

class SectionalController extends Controller
{
    protected $service;

    public function __construct(SectionalService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error'])
        {
            return responseFormatter::error($response['message'],$response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function show(string $id)
    {
    $response = $this->service->getById($id);

    if ($response['error'])
        return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function store(StoreSectionalRequest $request)
    {
    $data = $request->validated();

    $response = $this->service->create($data);

    if ($response['error'])
    {    
        return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateSectionalRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->service->update($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateSectionalRequest $request, string $id)
    {
    $data = $request->validated();

    $response = $this->service->partialUpdate($data, $id);

    if ($response['error'])
    {
        return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []); 
    }

    public function ChangeState(ChangeStateSectionalRequest $request, string $id)
    {
    $data = $request->validated();

    $response = $this->service->changeState($data, $id);

    if ($response['error'])
    {
        return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []); 
    }

    public function destroy(string $id)
    {
        $response = $this->service->delete($id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
