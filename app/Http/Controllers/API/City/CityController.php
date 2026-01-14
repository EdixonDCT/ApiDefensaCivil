<?php

namespace App\Http\Controllers\API\City;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\City\StoreCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Http\Requests\City\PartialUpdateCityRequest;
use App\Http\Requests\City\ChangeStateCityRequest;
use App\Http\Controllers\Controller;
use App\Services\City\CityService;

class CityController extends Controller
{
    protected $service;

    public function __construct(CityService $service)
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

    public function store(StoreCityRequest $request)
    {
    $data = $request->validated();

    $response = $this->service->create($data);

    if ($response['error'])
    {    
        return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateCityRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->service->update($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateCityRequest $request, string $id)
    {
    $data = $request->validated();

    $response = $this->service->partialUpdate($data, $id);

    if ($response['error'])
    {
        return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []); 
    }

    public function ChangeState(ChangeStateCityRequest $request, string $id)
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
    
    public function getApartment(string $id)
    {
    $response = $this->service->getAllForApartments($id);

    if ($response['error'])
        return ResponseFormatter::error($response['message'], $response['code']);

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
