<?php

namespace App\Policies;

use App\Models\FamilyPlan\FamilyPlan;
use App\Models\History\History;

class AccessPlanPolicy
{
    /**
     * Verifica si el usuario logueado tiene acceso a un FamilyPlan específico.
     *
     * @param int $planId
     * @return bool
     */
    public function access(int $planId): bool
    {
        $user = auth()->user(); // siempre usamos el usuario logueado
        if (!$user) return false;

        $plan = FamilyPlan::find($planId);
        if (!$plan) return false;

        $role = $user->roles->first()?->name ?? null;

        if ($role === 'Voluntario') {
            return History::where('user_id', $user->id)
                          ->where('family_plan_id', $planId)
                          ->exists();
        }

        if ($role === 'Supervisor') {
            return $user->profile &&
                   $user->profile->organization &&
                   $user->profile->organization->sectional_id === $plan->sectional_id;
        }

        // El rol administrador tiene acceso a los planes familiares
        return false;
    }
}
