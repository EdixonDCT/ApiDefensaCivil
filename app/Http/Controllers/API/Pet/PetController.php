<?php

namespace App\Http\Controllers\Api\Pet;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pet\StorePetRequest;
use App\Http\Requests\Pet\UpdatePetRequest;
use App\Http\Requests\Pet\PartialUpdatePetRequest;
use App\Models\Pet\pets;
use App\Services\Pet\PetService;

class PetController extends Controller
{
    protected $service;

    public function __construct(PetService $service)
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
        $pet = pets::find($id);

        if (!$pet) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        return ResponseFormatter::success("Registro obtenido exitosamente", 200, $pet);
    }

    public function store(StorePetRequest $request)
    {
        $response = $this->service->create($request->validated());

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdatePetRequest $request, string $id)
    {
        $pet = pets::find($id);

        if (!$pet) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        $response = $this->service->update($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdatePetRequest $request, string $id)
    {
        $pet = pets::find($id);

        if (!$pet) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        $response = $this->service->partialUpdate($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function destroy(string $id)
    {
        $pet = pets::find($id);

        if (!$pet) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        $response = $this->service->delete($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
