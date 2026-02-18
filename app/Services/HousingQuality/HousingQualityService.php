<?php

namespace App\Services\HousingQuality;

use App\Models\HousingQuality\HousingQuality;
use App\Models\Audit\Audit;
use Illuminate\Support\Arr;

class HousingQualityService
{
    public static function getAll()
    {
        $housingQuality = HousingQuality::all();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidades de vivienda obtenidas exitosamente",
            "data" => $housingQuality,
        ];
    }

    public function getById($id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidad de vivienda obtenida exitosamente",
            "data" => $housingQuality,
        ];
    }

    public function create(array $data)
    {
        $housingQuality = HousingQuality::create($data);

        $housingQuality->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Creado',
            'status_old'     => null,
            'status_new'     => $housingQuality->is_active ? "Activo" : "Inactivo",
        ]);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Calidad de vivienda creada exitosamente",
            "data" => $housingQuality,
        ];
    }

    public function update(array $data, $id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }

        $oldStatus = $housingQuality->is_active ? "Activo" : "Inactivo";

        $housingQuality->update($data);

        $housingQuality->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Actualizado',
            'status_old'     => $oldStatus,
            'status_new'     => $housingQuality->is_active ? "Activo" : "Inactivo",
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidad de vivienda actualizada exitosamente",
            "data" => $housingQuality,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }

        $oldStatus = $housingQuality->is_active ? "Activo" : "Inactivo";

        $housingQuality->update($data);

        $housingQuality->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Actualizado parcialmente',
            'status_old'     => $oldStatus,
            'status_new'     => $housingQuality->is_active ? "Activo" : "Inactivo",
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidad de vivienda actualizada parcialmente exitosamente",
            "data" => $housingQuality,
        ];
    }

    public function changeStatus(array $data, $id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }

        $oldStatus = $housingQuality->is_active ? "Activo" : "Inactivo";

        $housingQuality->update($data);

        $housingQuality->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Cambio de estado',
            'status_old'     => $oldStatus,
            'status_new'     => $housingQuality->is_active ? "Activo" : "Inactivo",
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado actualizado correctamente",
            "data" => $housingQuality,
        ];
    }

    public function delete($id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }

        if ($housingQuality->familyPlan->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar porque tiene registros relacionados",
            ];
        }

        $oldStatus = $housingQuality->is_active ? "Activo" : "Inactivo";

        $housingQuality->delete();

        $housingQuality->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Eliminado',
            'status_old'     => $oldStatus,
            'status_new'     => null,
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Calidad de vivienda eliminada exitosamente",
        ];
    }

    public function history($id)
    {
        $housingQuality = HousingQuality::find($id);

        if (!$housingQuality) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Calidad de vivienda no encontrada",
            ];
        }

        $history = $housingQuality->audits()
            ->orderBy('date_time', 'desc')
            ->get()
            ->map(function($audit) {
                return [
                    'date_time'      => $audit->date_time,
                    'user_name'      => $audit->user_name,
                    'rol'            => $audit->rol_name,
                    'action_execute' => $audit->action_execute,
                    'status_old'     => $audit->status_old,
                    'status_new'     => $audit->status_new,
                ];
            });

        return [
            "error" => false,
            "code" => 200,
            "message" => "Historial de auditoría obtenido exitosamente",
            "data" => $history,
        ];
    }
}
