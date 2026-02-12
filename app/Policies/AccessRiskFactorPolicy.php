<?php

namespace App\Policies;

use App\Models\RiskFactor\RiskFactor;
use App\Policies\AccessPlanPolicy;

class AccessRiskFactorPolicy
{
    public function access(RiskFactor $RiskFactor): bool
    {
        if (!$RiskFactor) return false;

        if (!$RiskFactor->family_plan_id) {
            return false;
        }

         return (new AccessPlanPolicy())->access($RiskFactor->family_plan_id);
    }
}
