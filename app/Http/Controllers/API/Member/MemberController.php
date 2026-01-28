<?php

namespace App\Http\Controllers\API\Member;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

/**
 * Requests para la validación de datos del Miembro.
 */
use App\Http\Requests\Member\StoreMemberRequest;
use App\Http\Requests\Member\UpdateMemberRequest;
use App\Http\Requests\Member\PartialUpdateMemberRequest;

/**
 * Servicio que contiene la lógica de negocio del Miembro.
 */
use App\Services\Member\MemberService;

/**
 * Controlador de Miembros.
 * Gestiona el registro, consulta y mantenimiento de los miembros del sistema.
 */
class MemberController extends Controller
{
    protected $service;

    /**
     * Inyección del servicio de lógica para la entidad Member.
     */
    public function __construct(MemberService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista todos los miembros registrados.
     */
    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Obtiene la información de un miembro específico por ID.
     */
    public function show(string $id)
    {
        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Registra un nuevo miembro en el sistema.
     */
    public function store(StoreMemberRequest $request, string $plan_id)
    {
        $data = $request->validated();
        $response = $this->service->create($data,$plan_id);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Actualización total de un miembro (PUT).
     */
    public function update(UpdateMemberRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->service->update($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Actualización parcial de un miembro (PATCH).
     */
    public function partialUpdate(PartialUpdateMemberRequest $request, string $id)
    {
        $data = $request->validated();
        $response = $this->service->partialUpdate($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    /**
     * Elimina un miembro del sistema.
     */
    public function destroy(string $id)
    {
        $response = $this->service->delete($id);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }
}
