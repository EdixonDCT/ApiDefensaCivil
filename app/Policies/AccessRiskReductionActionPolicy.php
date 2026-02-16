<?php

namespace App\Policies;

use App\Models\RiskReductionAction\RiskReductionAction;
use App\Models\RiskFactor\RiskFactor;
use App\Policies\AccessRiskFactorPolicy;

class AccessRiskReductionActionPolicy
{
    public function access(RiskReductionAction $riskReductionAction): bool
    {
        if (!$riskReductionAction) {
            return false;
        }

        $riskFactorId = $riskReductionAction->risk_factor_id;

        if (!$riskFactorId) {
            return false;
        }

        $riskFactor = RiskFactor::find($riskFactorId);

        if (!$riskFactor) {
            return false;
        }

        if (!$riskFactor->family_plan_id) {
            return false;
        }

        return (new AccessPlanPolicy())->access($riskFactor->family_plan_id);
    }
}
