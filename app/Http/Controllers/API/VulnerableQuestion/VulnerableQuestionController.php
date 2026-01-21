<?php

namespace App\Http\Controllers\API\VulnerableQuestion;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\VulnerableQuestion\VulnerableQuestionService;

use App\Http\Requests\VulnerableQuestion\StoreVulnerableQuestionRequest;
use App\Http\Requests\VulnerableQuestion\UpdateVulnerableQuestionRequest;
use App\Http\Requests\VulnerableQuestion\PartialUpdateVulnerableQuestionRequest;
use App\Http\Requests\VulnerableQuestion\ChangeStateVulnerableQuestionRequest;

class VulnerableQuestionController extends Controller
{
    protected $service;

    public function __construct(VulnerableQuestionService $service)
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

    public function store(StoreVulnerableQuestionRequest $request)
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

    public function update(UpdateVulnerableQuestionRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->service->update($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function partialUpdate(PartialUpdateVulnerableQuestionRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->service->partialUpdate($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function changeState(ChangeStateVulnerableQuestionRequest $request, string $id)
    {
        $data = $request->validated();

        $response = $this->service->changeState($data, $id);

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

    public function paginate()
    {
        $response = $this->service->paginate();

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
