<?php

namespace App\Services\Member;

use App\Models\Member\Member;
use App\Models\FamilyMember\FamilyMember;
use Illuminate\Support\Facades\DB;

class MemberService
{
    public function getAll()
    {
        $members = Member::all();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembros obtenidos exitosamente",
            "data" => $members,
        ];
    }

    public function getById($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro obtenido exitosamente",
            "data" => $member,
        ];
    }
    
    public function getMembersForPlan($family_plan_id)
    {
        $paginator = FamilyMember::where('family_plan_id', $family_plan_id)
            ->with([
                'member.bloodGroup', 
                'member.documentType', 
                'member.kinship'
            ])
            ->paginate(10);

        if ($paginator->isEmpty()) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "No se encontraron miembros para este plan familiar",
            ];
        }

        $paginator->getCollection()->transform(function ($item) {
            return [
                'full_name'       => $item->member->names . ' ' . $item->member->last_names,
                'birth_date'      => $item->member->birth_date,
                'blood_group'     => $item->member->bloodGroup->name,
                'document_type'   => $item->member->documentType->name,
                'document_number' => $item->member->document_number,
                'gender_id'       => $item->member->gender_id,
                'kinship'         => $item->member->kinship->name,
                'phone'           => $item->member->phone,
            ];
        });

        return [
            "error"   => false,
            "code"    => 200,
            "message" => "Miembros del plan familiar obtenidos exitosamente",
            "data"    => $paginator,
        ];
    }

    public function create(array $data, $plan_id)
    {
        DB::beginTransaction();

        try {
            // Validar cabeza de familia
            $existingHeads = FamilyMember::where('family_plan_id', $plan_id)
                ->whereHas('member', fn($q) => $q->where('kinship_id', 1)) // 1 = cabeza de familia
                ->count();

            if ($existingHeads === 0 && ($data['kinship_id'] ?? 0) != 1) {
                DB::rollBack();
                return [
                    "error" => true,
                    "code" => 400,
                    "message" => "El primer integrante del plan debe ser cabeza de familia",
                ];
            }

            if ($existingHeads > 0 && ($data['kinship_id'] ?? 0) == 1) {
                DB::rollBack();
                return [
                    "error" => true,
                    "code" => 400,
                    "message" => "Ya existe un miembro con rol cabeza de familia, no se puede duplicar",
                ];
            }

            $member = Member::create($data);

            FamilyMember::create([
                'member_id'      => $member->id,
                'family_plan_id' => $plan_id,
            ]);

            DB::commit();

            return [
                "error" => false,
                "code" => 201,
                "message" => "Miembro creado y asociado al plan familiar exitosamente",
                "data" => $member,
            ];

        } catch (\Throwable $e) {
            DB::rollBack();
            return [
                "error" => true,
                "code" => 500,
                "message" => "Error al crear el miembro",
                "details" => $e->getMessage(),
            ];
        }
    }

    public function update(array $data, $plan_id, $id)
    {
        $familyMember = FamilyMember::where('member_id', $id)->where('family_plan_id', $plan_id)->first();
        if (!$familyMember) return ["error" => true, "code" => 404, "message" => "Plan familiar no asociado al miembro"];

        $member = Member::find($id);
        if (!$member) return ["error" => true, "code" => 404, "message" => "Miembro no encontrado"];

        // Validar cambio de cabeza de familia
        if (isset($data['kinship_id']) && $data['kinship_id'] == 1) {
            $existingHead = FamilyMember::where('family_plan_id', $plan_id)
                ->whereHas('member', fn($q) => $q->where('kinship_id', 1))
                ->where('member_id', '!=', $id)
                ->first();

            if ($existingHead) {
                $prevHead = Member::find($existingHead->member_id);
                $prevHead->update(['kinship_id' => 17]); // rol anterior pasa a 17
            }
        }

        $member->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro actualizado exitosamente, pero el anterior cabeza de familia fue modificado",
            "data" => $member,
        ];
    }

    public function partialUpdate(array $data, $plan_id, $id)
    {
        return $this->update($data, $plan_id, $id); // misma lógica que update
    }

    public function delete($plan_id, $member_id)
    {
        $familyMember = FamilyMember::where('member_id', $member_id)
            ->where('family_plan_id', $plan_id)->first();

        if (!$familyMember) return ["error" => true, "code" => 404, "message" => "Miembro del plan familiar no encontrado"];

        $member = Member::find($member_id);
        if (!$member) return ["error" => true, "code" => 404, "message" => "Miembro no encontrado"];

        // Validar si es cabeza de familia
        if ($member->kinship_id == 1) {
            $otherMembers = FamilyMember::where('family_plan_id', $plan_id)
                ->where('member_id', '!=', $member_id)
                ->count();

            if ($otherMembers == 0) {
                return ["error" => true, "code" => 400, "message" => "No se puede eliminar al miembro cabeza de familia, debe asignar otro antes"];
            }
        }

        $familyMember->delete();
        $member->delete();

        return ["error" => false, "code" => 200, "message" => "Miembro eliminado exitosamente"];
    }
}
