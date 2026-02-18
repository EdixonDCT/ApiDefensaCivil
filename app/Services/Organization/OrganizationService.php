<?php

namespace App\Services\Organization;

use App\Models\Organization\Organization;
use App\Models\Sectional\Sectional;
use App\Models\Audit\Audit;
use Illuminate\Support\Arr;

class OrganizationService
{
    /**
     * Obtiene todas las organizaciones.
     */
    public static function getAll()
    {
        $organization = Organization::all();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organizaciones obtenidas exitosamente",
            "data" => $organization,
        ];
    }

    /**
     * Obtener por ID
     */
    public function getById($id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organización no encontrada",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organización obtenida exitosamente",
            "data" => $organization,
        ];
    }

    /**
     * Crear organización
     */
    public function create(array $data)
    {

        $organization = Organization::create($data);

        $organization->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Creado',
            'status_old'     => null,
            'status_new'     => $organization->is_active ? "Activo" : "Inactivo",
        ]);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Organización creada exitosamente",
            "data" => $organization,
        ];
    }

    /**
     * Update total
     */
    public function update(array $data, $id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organización no encontrada",
            ];
        }

        $oldStatus = $organization->is_active ? "Activo" : "Inactivo";

        $organization->update($data);

        $organization->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Actualizado',
            'status_old'     => $oldStatus,
            'status_new'     => $organization->is_active ? "Activo" : "Inactivo",
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organización actualizada exitosamente",
            "data" => $organization,
        ];
    }

    /**
     * Update parcial
     */
    public function partialUpdate(array $data, $id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organización no encontrada",
            ];
        }

        $oldStatus = $organization->is_active ? "Activo" : "Inactivo";

        $organization->update($data);

        $organization->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Actualizado parcialmente',
            'status_old'     => $oldStatus,
            'status_new'     => $organization->is_active ? "Activo" : "Inactivo",
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Organización actualizada parcialmente exitosamente",
            "data" => $organization,
        ];
    }

    /**
     * Cambio de estado
     */
    public function changeStatus(array $data, $id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organización no encontrada",
            ];
        }

        $oldStatus = $organization->is_active ? "Activo" : "Inactivo";

        $organization->update($data);

        $organization->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Cambio de estado',
            'status_old'     => $oldStatus,
            'status_new'     => $organization->is_active ? "Activo" : "Inactivo",
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado actualizado correctamente",
            "data" => $organization,
        ];
    }

    /**
     * Eliminación
     */
    public function delete($id)
    {
        $organization = Organization::find($id);

        if (!$organization){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organización no encontrada",
            ];
        }

        if ($organization->profile->count()) {
            return [
                "error" => true,
                "code" => 409,
                "message" => "No se puede eliminar porque tiene registros relacionados",
            ];
        }

        $oldStatus = $organization->is_active ? "Activo" : "Inactivo";

        $organization->delete();

        $organization->audits()->create([
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
            "message" => "Organización eliminada exitosamente",
        ];
    }

    /**
     * Historial
     */
    public function history($id)
    {
        $organization = Organization::find($id);

        if (!$organization) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Organización no encontrada",
            ];
        }

        $history = $organization->audits()
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
