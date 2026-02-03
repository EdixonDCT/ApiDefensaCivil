<?php

namespace App\Http\Controllers\API\ConditionMember;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\ConditionMember\StoreConditionMemberRequest;
use App\Http\Requests\ConditionMember\UpdateConditionMemberRequest;
use App\Http\Requests\ConditionMember\PartialUpdateConditionMemberRequest;
use App\Http\Controllers\Controller;
use App\Services\ConditionMember\ConditionMemberService;
use App\Policies\AccessConditionMemberPolicy;
use App\Policies\AccessPlanMemberPolicy;
use App\Models\ConditionMember\ConditionMember;
use App\Models\Member\Member;

class ConditionMemberController extends Controller
{
    protected $service;

    public function __construct(ConditionMemberService $service)
    {
        $this->service = $service;
        
        $this->conditionMemberPolicy = new AccessConditionMemberPolicy();

        $this->accessPlanMemberPolicy = new AccessPlanMemberPolicy();
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
        $conditionMember = ConditionMember::find($id);
        if (!$conditionMember) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        if (!$this->conditionMemberPolicy->access($conditionMember)) {
            return ResponseFormatter::error("No tiene acceso a este registro", 403);
        }

        return ResponseFormatter::success("Registro obtenido exitosamente", 200, $conditionMember);
    }

    public function getByMember(string $member_id)
    {
        // 1. Buscar el Member por ID
        $member = Member::find($member_id);
        if (!$member) {
            return ResponseFormatter::error('Miembro no encontrado', 404);
        }

        // 2. Validar acceso al plan del Member
        if (!$this->accessPlanMemberPolicy->access($member)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para ver los registros de este miembro',
                403
            );
        }

        // 3. Obtener las condiciones del Member
        $response = $this->service->getByMember($member_id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }


    public function store(StoreConditionMemberRequest $request)
    {
        $data = $request->validated();

        // 1. Buscar el member usando el member_id del request
        $member = Member::find($data['member_id']);

        if (!$member) {
            return ResponseFormatter::error('Miembro no encontrado', 404);
        }

        // Validación de acceso al plan
        if (!$this->accessPlanMemberPolicy->access($member)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para crear condiciones para este miembro',403
            );
        }

        // 3. Crear el registro (member_id ya viene validado)
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



    public function update(UpdateConditionMemberRequest $request, string $id)
    {
        $conditionMember = ConditionMember::find($id);
        if (!$conditionMember) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        if (!$this->conditionMemberPolicy->access($conditionMember)) {
            return ResponseFormatter::error("No tiene acceso a este registro", 403);
        }

        $data = $request->validated();
        $response = $this->service->update($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateConditionMemberRequest $request, string $id)
    {
        $conditionMember = ConditionMember::find($id);
        if (!$conditionMember) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        if (!$this->conditionMemberPolicy->access($conditionMember)) {
            return ResponseFormatter::error("No tiene acceso a este registro", 403);
        }

        $data = $request->validated();
        $response = $this->service->partialUpdate($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function destroy(string $id)
    {
        $conditionMember = ConditionMember::find($id);
        if (!$conditionMember) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        if (!$this->conditionMemberPolicy->access($conditionMember)) {
            return ResponseFormatter::error("No tiene acceso a este registro", 403);
        }

        $response = $this->service->delete($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
