<?php

namespace App\Policies;

use App\Models\Pet;
use App\Policies\AccessPlanPolicy;

class AccessPetPolicy
{
    public function access(Pet $pet): bool
    {
        // 1️⃣ Validar que el pet tenga family_plan_id
        if (!$pet) return false;

        if (!$pet->family_plan_id) {
            return false;
        }

        // 2️⃣ Delegar la validación al AccessPlanPolicy
        return $this->planPolicy->access($pet->family_plan_id);
    }
}
