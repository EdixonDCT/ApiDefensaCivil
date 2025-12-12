<?php

namespace App\Http\Controllers\API\Gender;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Gender\StoreGenderRequest;
use App\Http\Requests\Gender\UpdateGenderRequest;
use App\Http\Requests\Gender\PartialUpdateGenderRequest;
use App\Http\Requests\Gender\ChangeStateGenderRequest;
use App\Http\Controllers\Controller;
use App\Services\Gender\GenderService;

class GenderController extends Controller
{
    protected $service;

    public function __construct(GenderService $service)
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

    public function store(StoreGenderRequest $request)
    {
    $data = $request->validated();

    $response = $this->service->create($data);

    if ($response['error'])
    {    
        return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateGenderRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->service->update($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateGenderRequest $request, string $id)
    {
    $data = $request->validated();

    $response = $this->service->partialUpdate($data, $id);

    if ($response['error'])
    {
        return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []); 
    }

    public function ChangeState(ChangeStateGenderRequest $request, string $id)
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
