<?php

namespace App\Policies;

use App\Models\AvailableResource\AvailableResource;
use App\Policies\AccessPlanPolicy;

class AccessAvailableResourcePolicy
{
public function access(AvailableResource $availableResource): bool
    {
        if (!$availableResource) return false;

        if (!$availableResource->family_plan_id) {
            return false;
        }

         return (new AccessPlanPolicy())->access($availableResource->family_plan_id);
    }
}
