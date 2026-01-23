<?php

namespace App\Services\History;

use App\Models\History\History;
use App\Models\Sectional\Sectional;
use App\Models\User\User;
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Organization\Organization;
class HistoryService
{
    public static function getAll()
    {
        $histories = History::all();

        if ($histories->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay historiales registrados",
                "data" => $histories,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Historiales obtenidos exitosamente",
            "data" => $histories,
        ];
    }

    public function getById($id)
    {
        $history = History::find($id);

        if (!$history) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Historial no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Historial obtenido exitosamente",
            "data" => $history,
        ];
    }

    public function create(array $data)
    {
        $history = History::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Historial creado exitosamente",
            "data" => $history,
        ];
    }

    public function update(array $data, $id)
    {
        $history = History::find($id);

        if (!$history) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Historial no encontrado",
            ];
        }

        $history->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Historial actualizado exitosamente",
            "data" => $history,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $history = History::find($id);

        if (!$history) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Historial no encontrado",
            ];
        }

        $history->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Historial actualizado parcialmente exitosamente",
            "data" => $history,
        ];
    }

    public function delete($id)
    {
        $history = History::find($id);

        if (!$history) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Historial no encontrado",
            ];
        }

        $history->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Historial eliminado exitosamente",
        ];
    }

    public function getActionsByVoluntario()
    {
        $histories = History::where('user_id',auth()->id())
            ->where('action_id', 1)
            ->orderBy('date', 'desc')
            ->paginate(2);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Historial de planes familiares creados por el Voluntario obtenidos exitosamente",
            "data" => $histories,
        ];
    }

    public function getActionsBySupervisor()
    {
        $user = User::with('profile')->find(auth()->id());

        if (!$user || !$user->profile) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario o perfil no encontrado",
            ];
        }

        $sectionalId = Organization::find($user->profile->organization->sectional_id);

        // Ejecutamos la consulta y la paginamos
        $plans = FamilyPlan::where('sectional_id', $sectionalId)
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Planes familiares de la seccional supervisados obtenido exitosamente",
            "data" => $plans,
        ];
    }

    public function canAccessPlan($planId)
    {
        $user = User::with('profile.organization')->find(auth()->id());
        $plan = FamilyPlan::find($planId);

        if (!$user || !$plan) return false;

        $role = $user->roles->first()?->name ?? null;

        if ($role === 'Voluntario') {
            return History::where('user_id', auth()->id())->where('family_plan_id', $planId)->exists();
        }

        if ($role === 'Supervisor') {
            return $user->profile && $user->profile->organization && $user->profile->organization->sectional_id === $plan->sectional_id;
        }
        return false;
    }
}
