<?php

namespace App\Services\History;

use App\Models\History\History;
use App\Models\Sectional\Sectional;
use App\Models\User\User;
use App\Models\FamilyPlan\FamilyPlan;
use App\Models\Organization\Organization;

/**
 * Servicio para gestionar el historial de acciones y el control de acceso a los planes.
 */
class HistoryService
{
    /**
     * Obtiene todos los registros de historial.
     */
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

    /**
     * Obtiene un registro de historial específico.
     */
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

    /**
     * Crea una nueva entrada en el historial de forma manual.
     */
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

    /**
     * Actualiza un registro del historial.
     */
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

    /**
     * Actualización parcial de un registro de historial.
     */
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

    /**
     * Elimina un registro del historial.
     */
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

    /**
     * Obtiene los planes creados por el Voluntario autenticado.
     * Filtra por action_id = 1 (Creado) y pagina los resultados de 2 en 2.
     */
    public function getActionsByVoluntario()
    {
        $histories = History::with([
                'action:id,name',
                'familyPlan:id,last_names,city_id',
                'familyPlan.city:id,name,apartment_id',
                'familyPlan.city.apartment:id,name'
            ])
            ->where('user_id', auth()->id())
            ->where('action_id', 1)
            ->orderBy('date', 'desc')
            ->paginate(3);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Historial de planes familiares creados por el Voluntario obtenidos exitosamente",
            "data" => $histories,
        ];
    }

    /**
     * Obtiene los planes de la seccional a la que pertenece el Supervisor.
     */
    public function getActionsBySupervisor()
    {
        // Cargamos el usuario con su perfil para obtener la organización
        $user = User::with('profile.organization')->find(auth()->id());

        if (!$user || !$user->profile) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario o perfil no encontrado",
            ];
        }

        // Identificamos la seccional del supervisor
        $sectionalId = $user->profile->organization->sectional_id;

        // Filtramos los planes familiares que pertenecen a esa misma seccional
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

    /**
     * Valida si el usuario actual tiene permiso para acceder a un plan específico.
     * @param int $planId ID del plan a consultar.
     * @return bool
     */
    public function canAccessPlan($planId)
    {
        $user = User::with('profile.organization')->find(auth()->id());
        $plan = FamilyPlan::find($planId);

        if (!$user || !$plan) return false;

        $role = $user->roles->first()?->name ?? null;

        // Si es Voluntario: Solo puede acceder si él mismo creó el plan (existe en history)
        if ($role === 'Voluntario') {
            return History::where('user_id', auth()->id())
                          ->where('family_plan_id', $planId)
                          ->exists();
        }

        // Si es Supervisor: Puede acceder si el plan pertenece a su Seccional
        if ($role === 'Supervisor') {
            return $user->profile && 
                   $user->profile->organization && 
                   $user->profile->organization->sectional_id === $plan->sectional_id;
        }

        return false;
    }
}