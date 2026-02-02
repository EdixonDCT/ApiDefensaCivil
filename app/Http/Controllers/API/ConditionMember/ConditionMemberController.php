<?php

namespace App\Http\Controllers\API\ConditionMember;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\ConditionMember\StoreConditionMemberRequest;
use App\Http\Requests\ConditionMember\UpdateConditionMemberRequest;
use App\Http\Requests\ConditionMember\PartialUpdateConditionMemberRequest;
use App\Http\Controllers\Controller;
use App\Services\ConditionMember\ConditionMemberService;
use App\Policies\AccessConditionMemberPolicy;
use App\Models\ConditionMember\ConditionMember;

class ConditionMemberController extends Controller
{
    protected $service;
    protected AccessConditionMemberPolicy $conditionMemberPolicy;

    public function __construct(ConditionMemberService $service)
    {
        $this->service = $service;
        
        $this->conditionMemberPolicy = new AccessConditionMemberPolicy();
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
        $response = $this->service->getByMember($member_id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        // Filtrar registros por los que el usuario tiene acceso
        $accessible = collect($response['data'])->filter(function($cm) {
            return $this->conditionMemberPolicy->access($cm);
        });

        return ResponseFormatter::success(
            "Registros obtenidos exitosamente",
            200,
            $accessible->values()
        );
    }

    public function store(StoreConditionMemberRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->create($data);

        if ($response['error']) {    
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
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
