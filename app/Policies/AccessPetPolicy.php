<?php

namespace App\Policies;

use App\Models\Pet\Pet;
use App\Policies\AccessPlanPolicy;

class AccessPetPolicy
{
    public function access(Pet $Pet): bool
    {
        if (!$Pet) return false;

        if (!$Pet->family_plan_id) {
            return false;
        }

         return (new AccessPlanPolicy())->access($Pet->family_plan_id);
    }
}
