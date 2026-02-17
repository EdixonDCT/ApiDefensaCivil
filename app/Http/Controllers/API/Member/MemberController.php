<?php

namespace App\Http\Controllers\API\Member;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

use App\Http\Requests\Member\StoreMemberRequest;
use App\Http\Requests\Member\UpdateMemberRequest;
use App\Http\Requests\Member\PartialUpdateMemberRequest;

use App\Services\Member\MemberService;

use App\Models\Member\Member;
use App\Policies\AccessPlanPolicy;
use App\Policies\AccessPlanMemberPolicy;

class MemberController extends Controller
{
    protected $service;

    public function __construct(MemberService $service)
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
        $member = Member::find($id);
        if (!$member) {
            return ResponseFormatter::error('Miembro no encontrado', 404);
        }

        // Validación de acceso al member (y su plan)
        if (!(new AccessPlanMemberPolicy())->access($member)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para modificar este miembro',
                403
            );
        }
        
        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function getMembersForPlan(string $family_plan_id)
    {
        // Validación de acceso al plan
        if (!(new AccessPlanPolicy())->access($family_plan_id)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para acceder a este plan',
                403
            );
        }

        $response = $this->service->getMembersForPlan($family_plan_id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? [], $response['paginate']);
    }

    public function store(StoreMemberRequest $request, string $plan_id)
    {
        // Validación de acceso al plan
        if (!(new AccessPlanPolicy())->access($plan_id)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para agregar miembros a este plan',
                403
            );
        }

        $data = $request->validated();
        $response = $this->service->create($data, $plan_id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function update(UpdateMemberRequest $request, string $id)
    {
        $member = Member::find($id);
        if (!$member) {
            return ResponseFormatter::error('Miembro no encontrado', 404);
        }

        // Validación de acceso al member (y su plan)
        if (!(new AccessPlanMemberPolicy())->access($member)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para modificar este miembro',
                403
            );
        }

        $data = $request->validated();
        $response = $this->service->update($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function partialUpdate(PartialUpdateMemberRequest $request, string $id)
    {
        $member = Member::find($id);
        if (!$member) {
            return ResponseFormatter::error('Miembro no encontrado', 404);
        }

        if (!(new AccessPlanMemberPolicy())->access($member)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para modificar este miembro',
                403
            );
        }

        $data = $request->validated();
        $response = $this->service->partialUpdate($data, $id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }

    public function destroy(string $member_id)
    {
        $member = Member::find($member_id);
        if (!$member) {
            return ResponseFormatter::error('Miembro no encontrado', 404);
        }

        if (!(new AccessPlanMemberPolicy())->access($member)) {
            return ResponseFormatter::error(
                'Usted no tiene autorización para eliminar este miembro',
                403
            );
        }

        $response = $this->service->delete($member_id);

        if ($response['error']) {
            return ResponseFormatter::error($response['message'], $response['code']);
        }

        return ResponseFormatter::success($response['message'], $response['code'], $response['data'] ?? []);
    }
}
