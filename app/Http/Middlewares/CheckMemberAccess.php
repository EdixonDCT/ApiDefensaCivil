<?php

namespace App\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\History\History;
use App\Helpers\ResponseFormatter;

class CheckMemberAccess
{
    public function handle(Request $request, Closure $next)
    {
        $planId = $request->route('plan_id');

        if (!$planId) {
            return ResponseFormatter::error("No se especificó el plan_id", 400);
        }

        $user = User::with('profile.organization')->find(auth()->id());
        $plan = FamilyPlan::find($planId);

        if (!$user || !$plan) {
            return ResponseFormatter::error("Usuario o Plan no encontrado", 404);
        }

        $role = $user->roles->first()?->name ?? null;

        $hasAccess = false;

        if ($role === 'Voluntario') {
            $hasAccess = History::where('user_id', auth()->id())
                                ->where('family_plan_id', $planId)
                                ->exists();
        } elseif ($role === 'Supervisor') {
            $hasAccess = $user->profile &&
                         $user->profile->organization &&
                         $user->profile->organization->sectional_id === $plan->sectional_id;
        } else {
            $hasAccess = true;
        }

        if (!$hasAccess) {
            return ResponseFormatter::error(
                "Usted no tiene autorización para acceder a este Plan Familiar",
                403
            );
        }

        return $next($request);
    }
}
