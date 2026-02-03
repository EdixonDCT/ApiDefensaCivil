<?php

namespace App\Policies;

use App\Models\ConditionMember\ConditionMember;
use App\Policies\AccessPlanPolicy;

class AccessConditionMemberPolicy
{
    protected AccessPlanPolicy $planPolicy;

    public function __construct()
    {
        $this->planPolicy = new AccessPlanPolicy();
    }

    /**
     * Verifica si el usuario logueado tiene acceso a un ConditionMember
     *
     * @param ConditionMember $conditionMember
     * @return bool
     */
    public function access(ConditionMember $conditionMember): bool
    {
        // 1️⃣ Obtener el miembro
        $member = $conditionMember->member;
        if (!$member) return false;

        // 2️⃣ Obtener la relación con FamilyMember
        $familyMember = $member->familyMember()->first(); // asumimos que un member puede estar en varios planes, usamos el primero
        if (!$familyMember) return false;

        // 3️⃣ Obtener el FamilyPlan
        $familyPlan = $familyMember->familyPlan;
        if (!$familyPlan) return false;

        // 4️⃣ Delegar la validación al AccessPlanPolicy
        return $this->planPolicy->access($familyPlan->id);
    }
}
