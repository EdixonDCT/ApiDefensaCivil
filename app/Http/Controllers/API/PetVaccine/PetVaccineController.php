<?php

namespace App\Http\Controllers\Api\PetVaccine;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetVaccine\StorePetVaccineRequest;
use App\Http\Requests\PetVaccine\UpdatePetVaccineRequest;
use App\Http\Requests\PetVaccine\PartialUpdatePetVaccineRequest;
use App\Models\PetVaccine\PetVaccine;
use App\Models\Pet\Pet;
use App\Services\PetVaccine\PetVaccineService;
use App\Policies\AccessPetPolicy;
use App\Policies\AccessPetVaccinePolicy;

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

        if (!(new AccessPetVaccinePolicy())->access($petVaccine)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para ver esta vacuna de esta mascota',
                403
            );
        }

        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function getVaccinesForPets(string $pet)
    {
        $pet = Pet::find($pet);

        if (!$pet) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        if (!(new AccessPetPolicy())->access($pet)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para acceder a esta vacunas de esta mascota',
                403
            );
        }

        $response = $this->service->getByPet($pet->id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function store(StorePetVaccineRequest $request)
    {
        // Validación de acceso al plan
        if (!(new AccessPetPolicy())->access($request->pet_id))
        {
            return ResponseFormatter::error(
                'Usted no tiene autorización para agregar vacunas a esta mascota',
                403
            );
        }
        $data = $request->validated();
        $response = $this->service->create($data);

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

        // Validación de acceso al plan
        if (!(new AccessPetVaccinePolicy())->access($petVaccine))
        {
            return ResponseFormatter::error(
                'Usted no tiene autorización para actualizar las vacunas de esta mascota',
                403
            );
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

        // Validación de acceso al plan
        if (!(new AccessPetVaccinePolicy())->access($petVaccine))
        {
            return ResponseFormatter::error(
                'Usted no tiene autorización para actualizar las vacunas de esta mascota',
                403
            );
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

        // Validación de acceso al plan
        if (!(new AccessPetVaccinePolicy())->access($petVaccine))
        {
            return ResponseFormatter::error(
                'Usted no tiene autorización para eliminar las vacunas de esta mascota',
                403
            );
        }

        $response = $this->service->delete($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
