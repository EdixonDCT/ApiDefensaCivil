<?php

namespace App\Http\Controllers\API\FamilyMember;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\FamilyMember\FamilyMemberService;
use App\Http\Requests\FamilyMember\StoreFamilyMemberRequest;
use App\Http\Requests\FamilyMember\UpdateFamilyMemberRequest;

/**
 * Controlador para la gestión de miembros asociados a planes familiares.
 */
class FamilyMemberController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de FamilyMember.
     */
    public function __construct(FamilyMemberService $service)
    {
        $this->service = $service;
    }

    /**
     * Obtiene todas las relaciones de miembros con planes familiares.
     */
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

    /**
     * Obtiene la información de una relación familiar específica.
     */
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

    /**
     * Asocia un miembro a un plan familiar.
     */
    public function store(StoreFamilyMemberRequest $request)
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

    /**
     * Actualización total de la relación familiar (PUT).
     */
    public function update(UpdateFamilyMemberRequest $request, string $id)
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

    /**
     * Elimina la relación entre el miembro y el plan familiar.
     */
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
}
