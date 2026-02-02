<?php

namespace App\Policies;

use App\Models\Member\Member;
use App\Policies\AccessPlanPolicy;

class AccessPlanMemberPolicy
{
    /**
     * Verifica si el usuario logueado tiene acceso al plan
     * al que pertenece un Member específico.
     *
     * @param Member $member
     * @return bool
     */
    public function access(Member $member): bool
    {
        $user = auth()->user(); // siempre usamos el usuario logueado
        if (!$user) return false;

        // Obtenemos el FamilyMember vinculado
        $familyMember = $member->familyMembers()->first();
        if (!$familyMember) return false;

        // Obtenemos el FamilyPlan del FamilyMember
        $plan = $familyMember->familyPlan;
        if (!$plan) return false;

        // Reutilizamos la AccessPlanPolicy
        return (new AccessPlanPolicy())->access($plan->id);
    }
}
