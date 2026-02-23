<?php

namespace App\Services\FamilyPlan;

use App\Models\FamilyPlan\FamilyPlan;
use App\Models\History\History;
use Illuminate\support\Arr;

/**
 * Servicio para la gestión de Planes Familiares.
 * Incluye lógica de auditoría para el seguimiento de registros.
 */
class FamilyPlanService
{
    /**
     * Obtiene todos los planes familiares registrados.
     * @return array
     */
    public static function getAll()
    {
        $familyPlan = FamilyPlan::all();

        if ($familyPlan->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay planes familiares registrados",
                "data" => $familyPlan,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "planes familiares obtenidos exitosamente",
            "data" => $familyPlan,
        ];
    }

    /**
     * Obtiene un plan familiar específico por su ID.
     */
    public function getById($id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan familiar obtenido exitosamente",
            "data" => $familyPlan,
        ];
    }

    /**
     * Crea un plan familiar y registra la acción en el historial.
     * @param array $data Datos del plan.
     * @return array
     */
    public function create(array $data)
    {
        $familyPlan = FamilyPlan::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Plan familiar creado exitosamente",
            "data" => $familyPlan,
        ];
    }

    /**
     * Actualización completa de un plan familiar.
     */
    public function update(array $data, $id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        $familyPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan familiar actualizado exitosamente",
            "data" => $familyPlan,
        ];
    }

    /**
     * Actualización parcial de campos del plan.
     */
    public function partialUpdate(array $data,$id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        $familyPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan familiar actualizado parcialmente exitosamente",
            "data" => $familyPlan,
        ];
    }

    /**
     * Actualiza el estado actual del plan familiar.
     */
    public function changeStatus(array $data,$id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }
        $oldStatus = $familyPlan->status_plan_id;
        $familyPlan->update($data);
    // 🔹 Estado nuevo
        $familyPlan->refresh()->load('statusPlan');
        $newStatus = $familyPlan->status_plan_id;

        // 🔹 Validación
        if ($newStatus != 1 && $newStatus != 2 && $newStatus != 3) { // aquí pones el estado que quieras validar
            $familyPlan->audits()->create([
                'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
                'rol_name'       => auth()->user()->getRoleNames()->first(),
                'date_time'      => now(),
                'action_execute' => 'Cambio de estado del plan familiar',
                'status_old'     => $oldStatus,
                'status_new'     => $newStatus,
            ]);
        }
        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado del plan familiar actualizado correctamente",
            "data" => $familyPlan,
        ];
    }

    /**
     * Actualiza la información de coordenadas y georreferenciación.
     */
    public function georeferencing(array $data,$id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        $familyPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Georreferenciacion del plan familiar actualizado correctamente",
            "data" => $familyPlan,
        ];
    }

    /**
     * Actualiza los datos de identificación específicos del plan.
     */
    public function identify(array $data,$id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }

        $familyPlan->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Identificacion del plan familiar actualizado correctamente",
            "data" => $familyPlan,
        ];
    }

    /**
     * Elimina un plan familiar del sistema.
     */
    public function delete($id)
    {
        $familyPlan = FamilyPlan::find($id);

        if (!$familyPlan){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
            ];
        }
        History::where('family_plan_id', $id)->delete();
        
        $familyPlan->delete();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Plan familiar eliminado exitosamente",
        ];
    }

    public function checkAccess(string $planId): array
    {
        $user = auth()->user();
        $access = false;

        if (!$user) {
            return [
                "error" => true,
                "code" => 401,
                "message" => "Usuario no autenticado",
                "data" => [
                    "access_check" => $access
                ]
            ];
        }

        $plan = FamilyPlan::find($planId);

        if (!$plan) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Plan familiar no encontrado",
                "data" => [
                "access_check" => $access
            ]
            ];
        }

        $roleId = $user->roles->first()?->id ?? null;

        // 🔴 Si NO es 2 ni 3 → sin acceso
        if ($roleId != 2 && $roleId != 3) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "Verificación de acceso realizada",
                "data" => [
                "access_check" => $access
            ]
            ];
        }

        // 🟢 Rol 3 → Voluntario
        if ($roleId == 3) {

            // No puede acceder si el estado es 4 o 6
            if (!in_array($plan->status_plan_id, [1,2,4,6])) {
                $access = $plan->user_id == $user->id;
            }
        }

        // 🔵 Rol 2 → Supervisor
        if ($roleId == 2) {

            if (
                $user->profile &&
                $user->profile->organization &&
                $user->profile->organization->sectional_id === $plan->sectional_id &&
                $plan->status_plan_id == 4
            ) {
                $access = true;
            }
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Verificación de acceso realizada",
            "data" => [
                "access_check" => $access
            ]
        ];
    }

    public function getFamilyPlanByUser()
    {
        $user = auth()->user();

        if (!$user) {
            return [
                "error" => true,
                "code" => 401,
                "message" => "Usuario no autenticado",
            ];
        }

        $roleId = $user->roles->first()?->id ?? null;

        if ($roleId != 2 && $roleId != 3) {
            return [
                "error" => true,
                "code" => 403,
                "message" => "Este rol no tiene acceso a los planes familiares",
            ];
        }

        // 🟢 Rol 3 → Voluntario
        if ($roleId == 3) {

            $plans = FamilyPlan::where('user_id', $user->id)
                ->whereNotIn('status_plan_id', [4 ])
                ->with('statusPlan','city','city.apartment')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return [
                "error" => false,
                "code" => 200,
                "message" => $plans->isEmpty()
                    ? "No hay planes familiares disponibles"
                    : "Planes familiares obtenidos exitosamente",
                "data" => $plans->getCollection()->transform(function ($plan) {
                    return [
                        "id" => $plan->id,
                        "last_names" => $plan->last_names,
                        "city" => $plan->city->name,
                        "department" => $plan->city->apartment->name,
                        "status" => $plan->statusPlan->name,
                        "date_create" => $plan->created_at->format('d/m/Y'),
                    ];
                }),
                "paginate" => [
                    'current_page' => $plans->currentPage(),
                    'per_page' => $plans->perPage(),
                    'total' => $plans->total(),
                    'last_page' => $plans->lastPage(),
                    'from' => $plans->firstItem(),
                    'to' => $plans->lastItem(),
                ],
            ];
        }

        // 🔵 Rol 2 → Supervisor
        if ($roleId == 2) {

            if (!$user->profile || !$user->profile->organization) {
                return [
                    "error" => true,
                    "code" => 404,
                    "message" => "Perfil u organización no encontrada",
                ];
            }

            $sectionalId = $user->profile->organization->sectional_id;

            $plans = FamilyPlan::where('sectional_id', $sectionalId)
                ->where('status_plan_id', 4)
                ->with('statusPlan','city','city.apartment')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return [
                "error" => false,
                "code" => 200,
                "message" => $plans->isEmpty()
                    ? "No hay planes familiares disponibles"
                    : "Planes familiares obtenidos exitosamente",
                "data" => $plans->getCollection()->transform(function ($plan) {
                    return [
                        "id" => $plan->id,
                        "last_names" => $plan->last_names,
                        "city" => $plan->city->name,
                        "department" => $plan->city->apartment->name,
                        "status" => $plan->statusPlan->name,
                        "date_create" => $plan->created_at->format('d/m/Y'),
                    ];
                }),
                "paginate" => [
                    'current_page' => $plans->currentPage(),
                    'per_page' => $plans->perPage(),
                    'total' => $plans->total(),
                    'last_page' => $plans->lastPage(),
                    'from' => $plans->firstItem(),
                    'to' => $plans->lastItem(),
                ],
            ];
        }
    }
}