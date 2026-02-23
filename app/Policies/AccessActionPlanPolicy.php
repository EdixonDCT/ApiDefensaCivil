<?php

namespace App\Policies;

use App\Models\ActionPlan\ActionPlan;
use App\Policies\AccessPlanPolicy;

class AccessActionPlanPolicy
{
    /**
     * Verifica si el usuario logueado tiene acceso
     * al plan asociado a un ActionPlan específico.
     *
     * @param ActionPlan $actionPlan
     * @return bool
     */
    public function access(ActionPlan $actionPlan): bool
    {
        //Obtener el Member
        $member = $actionPlan->member;
        if (!$member) return false;

        //Obtener el RiskFactor
        $riskFactor = $actionPlan->riskFactor;
        if (!$riskFactor) return false;

        //Obtener FamilyPlan desde Member
        $familyMember = $member->familyMember()->first();
        if (!$familyMember) return false;

        $memberPlan = $familyMember->familyPlan;
        if (!$memberPlan) return false;

        //Obtener FamilyPlan desde RiskFactor
        $riskPlan = $riskFactor->familyPlan;
        if (!$riskPlan) return false;

        //Validar que ambos pertenezcan al mismo plan
        if ($memberPlan->id !== $riskPlan->id) {
            return false;
        }

        //Delegar validación final al AccessPlanPolicy
        return (new AccessPlanPolicy())->access($memberPlan->id);
    }
}
