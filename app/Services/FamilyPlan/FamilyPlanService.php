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
        // 1. Crear el registro del Plan Familiar
        $familyPlan = FamilyPlan::create($data);

        // 2. Registrar la auditoría en la tabla History
        History::create([
            'user_id' => auth()->id(), // Usuario que realiza la acción
            'family_plan_id' => $familyPlan->id,
            'action_id' => 1, // ID representativo del estado "Creado"
        ]);

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
    public function changeState(array $data,$id)
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

    if ($user) {
        $plan = FamilyPlan::find($planId);

        if ($plan) {

            $role = $user->roles->first()?->name ?? null;

            // 🔹 Voluntario
            if ($role === 'Voluntario') {
                $access = History::where('user_id', $user->id)
                    ->where('family_plan_id', $planId)
                    ->exists();
            }

            // 🔹 Supervisor
            if ($role === 'Supervisor') {
                $access = $user->profile &&
                          $user->profile->organization &&
                          $user->profile->organization->sectional_id === $plan->sectional_id;
            }
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
}