<?php

namespace App\Http\Controllers\API\Profile;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\Profile\StoreProfileRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Requests\Profile\PartialUpdateProfileRequest;
use App\Http\Controllers\Controller;
use App\Services\Profile\ProfileService;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(ProfileService $service)
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

    public function store(StoreProfileRequest $request)
    {
    $data = $request->validated();

    $response = $this->service->create($data);

    if ($response['error'])
    {    
        return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateProfileRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->service->update($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateProfileRequest $request, string $id)
    {
    $data = $request->validated();

    $response = $this->service->partialUpdate($data, $id);

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
