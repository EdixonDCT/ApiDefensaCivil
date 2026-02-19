<?php

namespace App\Services\Member;

use App\Models\Member\Member;
use App\Models\FamilyMember\FamilyMember;
use App\Models\ConditionMember\ConditionMember;
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
        $member = Member::with(['bloodGroup','documentType','kinship','gender','nationality'])->find($id);
        $conditionMember = $member->conditionMember;

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
            "data" => $member,$conditionMember,
        ];
    }
    
    public function getMembersForPlan($family_plan_id)
    {
        $paginator = FamilyMember::where('family_plan_id', $family_plan_id)
            ->with(['member.bloodGroup','member.documentType','member.kinship'])
            ->paginate(10);

        // Transformar aunque esté vacío (no rompe)
        $items = $paginator->getCollection()->transform(function ($item) {
            return [
                'id'               => $item->member->id,
                'full_name'        => $item->member->names . ' ' . $item->member->last_names,
                'birth_date'       => $item->member->birth_date,
                'blood_group'      => $item->member->bloodGroup->name,
                'document_number'  => $item->member->document_number,
                'gender_id'        => $item->member->gender_id,
                'kinship'          => $item->member->kinship->name,
                'phone'            => $item->member->phone,
            ];
        });

        return [
            "error"   => false,
            "code"    => 200,
            "message" => $items->isEmpty()
                ? "Este plan familiar no tiene miembros registrados"
                : "Miembros del plan familiar obtenidos exitosamente",
            "data"    => $items,
            'paginate' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
        ];
    }

    public function getMembersSelect($family_plan_id)
    {
        $collection = FamilyMember::where('family_plan_id', $family_plan_id)->with(['member.kinship'])->get();

        $items = $collection->transform(function ($item) {
            return [
                'id'              => $item->member->id,
                'full_name'       => $item->member->names . ' ' . $item->member->last_names,
                'document_number' => $item->member->document_number,
                'kinship'         => $item->member->kinship->name,
            ];
        });
        
        return [
            "error"   => false,
            "code"    => 200,
            "message" => "Miembros del plan familiar obtenidos exitosamente",
            "data"    => $items,
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

    public function update(array $data, $id)
    {
        // 1️⃣ Buscar la relación FamilyMember del miembro
        $familyMember = FamilyMember::where('member_id', $id)->first();

        if (!$familyMember) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no asociado al miembro"
            ];
        }

        // 2️⃣ Buscar miembro
        $member = Member::find($id);
        if (!$member) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro no encontrado"
            ];
        }

        // 3️⃣ Validar cambio de cabeza de familia
        if (isset($data['kinship_id']) && $data['kinship_id'] == 1) {
            $existingHead = FamilyMember::where('family_plan_id', $familyMember->family_plan_id)
                ->whereHas('member', fn($q) => $q->where('kinship_id', 1))
                ->where('member_id', '!=', $id)
                ->first();

            if ($existingHead) {
                $prevHead = Member::find($existingHead->member_id);
                $prevHead->update(['kinship_id' => 17]); // el rol anterior pasa a 17
            }
        }

        // 4️⃣ Actualizar datos del miembro
        $member->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro actualizado exitosamente, pero el anterior cabeza de familia fue modificado",
            "data" => $member,
        ];
    }


    public function partialUpdate(array $data, $id)
    {
        return $this->update($data, $id); // misma lógica que update
    }

    public function delete($member_id)
    {
        // 1️⃣ Buscar la relación FamilyMember
        $familyMember = FamilyMember::where('member_id', $member_id)->first();

        if (!$familyMember) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro del plan familiar no encontrado"
            ];
        }

        // 2️⃣ Buscar miembro
        $member = Member::find($member_id);

        if (!$member) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Miembro no encontrado"
            ];
        }

        // 3️⃣ Contar miembros del plan usando family_plan_id del FamilyMember
        $totalMembers = FamilyMember::where('family_plan_id', $familyMember->family_plan_id)->count();

        // 4️⃣ Validar cabeza de familia
        if ($member->kinship_id == 1 && $totalMembers > 1) {
            return [
                "error" => true,
                "code" => 400,
                "message" => "No se puede eliminar al cabeza de familia mientras existan otros integrantes, a menos que se otorgue la posición de cabeza de familia a otro miembro"
            ];
        }

        $conditionMembers = ConditionMember::where('member_id', $member_id)->exists();

        if ($conditionMembers) {
            return [
                "error" => true,
                "code" => 400,
                "message" => "No se puede eliminar porque posee condiciones"
            ];
        }

        // Si no tiene condiciones, se elimina
        $familyMember->delete();
        $member->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Miembro eliminado exitosamente"
        ];
    }
}
