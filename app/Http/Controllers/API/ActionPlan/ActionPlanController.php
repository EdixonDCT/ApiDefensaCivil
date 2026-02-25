<?php

namespace App\Http\Controllers\Api\ActionPlan;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActionPlan\StoreActionPlanRequest;
use App\Http\Requests\ActionPlan\UpdateActionPlanRequest;
use App\Http\Requests\ActionPlan\PartialUpdateActionPlanRequest;
use App\Models\ActionPlan\ActionPlan;
use App\Models\Member\Member;
use App\Models\RiskFactor\RiskFactor;
use App\Models\FamilyPlan\FamilyPlan;
use App\Services\ActionPlan\ActionPlanService;
use App\Policies\AccessActionPlanPolicy;
use App\Policies\AccessPlanPolicy;

class ActionPlanController extends Controller
{
    protected $service;
    
    public function __construct(ActionPlanService $service)
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
        $ActionPlan = ActionPlan::find($id);

        if (!$ActionPlan) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        if (!(new AccessActionPlanPolicy())->access($ActionPlan)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para modificar este plan de accion',
                403
            );
        }

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

    public function getByPlan(string $id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan) {
            return ResponseFormatter::error("Plan familiar no encontrado", 404);
        }

        if (!(new AccessPlanPolicy())->access($id)) {
            return ResponseFormatter::error('Usted no tiene autorización acceder al plan de accion de este plan familiar',403);
        }

        $response = $this->service->getByPlan($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function getByPlanBoolean(string $id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan) {
            return ResponseFormatter::error("Plan familiar no encontrado", 404);
        }

        if (!(new AccessPlanPolicy())->access($id)) {
            return ResponseFormatter::error('Usted no tiene autorización acceder al plan de accion de este plan familiar',403);
        }

        $response = $this->service->getByPlanBoolean($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function store(StoreActionPlanRequest $request)
    {
        $member = Member::find($request->member_id);

        if (!$member) {
            return ResponseFormatter::error("Integrante no encontrado", 404);
        }

        $riskFactor = RiskFactor::find($request->risk_factor_id);

        if (!$riskFactor) {
            return ResponseFormatter::error("Factor de riesgo no encontrado", 404);
        }

        // 🔹 Obtener FamilyPlan desde Member
        $familyMember = $member->familyMember()->first();
        if (!$familyMember || !$familyMember->familyPlan) {
            return ResponseFormatter::error("El integrante no pertenece a un plan familiar válido", 400);
        }

        $memberPlan = $familyMember->familyPlan;

        // 🔹 Obtener FamilyPlan desde RiskFactor
        if (!$riskFactor->familyPlan) {
            return ResponseFormatter::error("El factor de riesgo no pertenece a un plan familiar válido", 400);
        }

        $riskPlan = $riskFactor->familyPlan;

        // 🔹 Validar que ambos pertenezcan al mismo plan
        if ($memberPlan->id !== $riskPlan->id) {
            return ResponseFormatter::error(
                "El integrante y el factor de riesgo no pertenecen al mismo plan familiar",
                403
            );
        }

        // 🔹 Validar acceso al plan
        if (!(new AccessPlanPolicy())->access($memberPlan->id)) {
            return ResponseFormatter::error(
                "Usted no tiene autorización para crear este plan de acción",
                403
            );
        }

        $responseRepeat = $this->service->getByPlanBooleanBackend($memberPlan->id);
        if ($responseRepeat) {
            return ResponseFormatter::error($responseRepeat,409);
        }
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


    public function update(UpdateActionPlanRequest $request, string $id)
    {
        $ActionPlan = ActionPlan::find($id);

        if (!$ActionPlan) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        if (!(new AccessActionPlanPolicy())->access($ActionPlan)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para modificar este plan de accion',
                403
            );
        }

        $response = $this->service->update($request->validated(), $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function partialUpdate(PartialUpdateActionPlanRequest $request, string $id)
    {
        $ActionPlan = ActionPlan::find($id);

        if (!$ActionPlan) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        if (!(new AccessActionPlanPolicy())->access($ActionPlan)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para modificar este plan de accion',
                403
            );
        }

        $response = $this->service->partialUpdate($request->validated(), $id);

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
        $ActionPlan = ActionPlan::find($id);

        if (!$ActionPlan) {
            return ResponseFormatter::error("Registro no encontrado", 404);
        }

        if (!(new AccessActionPlanPolicy())->access($ActionPlan)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para modificar este plan de accion',
                403
            );
        }

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
