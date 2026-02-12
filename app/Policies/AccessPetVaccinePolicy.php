<?php

namespace App\Policies;

use App\Models\PetVaccine\PetVaccine;
use App\Policies\AccessPlanPolicy;

class AccessPetVaccinePolicy
{
    public function access(PetVaccine $petVaccine): bool
    {
        if (!$petVaccine) {
            return false;
        }

        // Cargar la mascota si no viene cargada
        if (!$petVaccine->pet) {
            return false;
        }

        $planId = $petVaccine->pet->family_plan_id;

        return (new AccessPlanPolicy())->access($planId);
    }
}
