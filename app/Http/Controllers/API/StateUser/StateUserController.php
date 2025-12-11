<?php

namespace App\Http\Controllers\API\StateUser;

use App\Helpers\ResponseFormatter;
use Illuminate\Http\Request;
use App\Models\StateUser\StateUser;
use App\Http\Requests\StateUser\StateUserRequest;
use App\Http\Controllers\Controller;
use App\Services\StateUser\StateUserService;

class stateUserController extends Controller
{
    protected $service;

    public function __construct(StateUserService $service)
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

    public function store(StateUserRequest $request)
    {
    $data = $request->validated();

    $response = $this->service->create($data);

    if ($response['error'])
    {    
        return ResponseFormatter::error($response['message'], $response['code']);
    }

    return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(StateUserRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->service->update($data, $id);

        if ($response['error'])
        {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(StateUserRequest $request, string $id)
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
