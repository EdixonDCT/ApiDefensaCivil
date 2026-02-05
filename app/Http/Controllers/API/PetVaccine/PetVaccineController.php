<?php

namespace App\Http\Controllers\Api\PetVaccine;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetVaccine\StorePetVaccineRequest;
use App\Http\Requests\PetVaccine\UpdatePetVaccineRequest;
use App\Http\Requests\PetVaccine\PartialUpdatePetVaccineRequest;
use App\Models\PetVaccine\PetVaccine;
use App\Services\PetVaccine\PetVaccineService;

class PetVaccineController extends Controller
{
    protected $service;

    public function __construct(PetVaccineService $service)
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
        $petVaccine = PetVaccine::find($id);

        if (!$petVaccine) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        return ResponseFormatter::success("Registro obtenido exitosamente", 200, $petVaccine);
    }

    public function store(StorePetVaccineRequest $request)
    {
        $response = $this->service->create($request->validated());

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdatePetVaccineRequest $request, string $id)
    {
        $petVaccine = PetVaccine::find($id);

        if (!$petVaccine) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        $response = $this->service->update($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdatePetVaccineRequest $request, string $id)
    {
        $petVaccine = PetVaccine::find($id);

        if (!$petVaccine) {
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
        $petVaccine = PetVaccine::find($id);

        if (!$petVaccine) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        $response = $this->service->delete($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
