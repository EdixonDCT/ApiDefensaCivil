<?php

namespace App\Services\Gender;

use App\Models\Gender\Gender;
use App\Models\Audit\Audit;
use Illuminate\support\Arr;

/**
 * Servicio encargado de la gestión de los géneros del sistema.
 */
class GenderService
{
    /**
     * Obtiene la lista completa de géneros registrados.
     * @return array Respuesta con la colección de géneros.
     */
    public static function getAll()
    {
        $gender = Gender::all();

        return [
            "error" => false,
            "code" => 200,
            "message" => "Generos obtenidos exitosamente",
            "data" => $gender,
        ];
    }

    /**
     * Busca un género específico por su ID.
     * @param int|string $id
     * @return array
     */
    public function getById($id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero obtenido exitosamente",
            "data" => $gender,
        ];
    }

    /**
     * Crea un nuevo registro de género.
     * @param array $data
     * @return array
     */
    public function create(array $data)
    {
        $gender = Gender::create($data);

        
        $gender->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Creado',
            'status_old'     => null,
            'status_new' => 'Activo',
        ]);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Genero creado exitosamente",
            "data" => $gender,
        ];
    }

    /**
     * Actualización total de la información de un género.
     */
    public function update(array $data, $id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        $oldStatus = $gender->is_active ? "Activo" : "Inactivo"; // si quieres auditar algún campo específico

        $gender->update($data);

        // Guardar auditoría
        $gender->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Actualizado',
            'status_old'     => $oldStatus,
            'status_new'     => $gender->is_active ? "Activo" : "Inactivo",
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero actualizado exitosamente",
            "data" => $gender,
        ];
    }

    /**
     * Actualización parcial de los datos del género.
     */
    public function partialUpdate(array $data, $id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        // Guardar estado viejo específico si existe
        $oldStatus = $gender->is_active ? "Activo" : "Inactivo";

        $gender->update($data);

        // Guardar auditoría de los cambios
        $newStatus = $gender->is_active ? "Activo" : "Inactivo";
        $gender->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Actualizado parcialmente',
            'status_old'     => $oldStatus,
            'status_new'     => $newStatus,
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero actualizado parcialmente exitosamente",
            "data" => $gender,
        ];
    }

    /**
     * Modifica el estado de habilitación del género.
     */
    public function changeStatus(array $data, $id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        // Solo guardamos el estado viejo
        $oldStatus = $gender->is_active ? "Activo" : "Inactivo";

        // Actualizamos únicamente el campo de estado
        $gender->update($data);

        $newStatus = $gender->is_active ? "Activo" : "Inactivo";

        // Auditoría específica para cambio de estado
        $gender->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Cambio de estado',
            'status_old'     => $oldStatus,
            'status_new'     => $newStatus,
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cambio de estado de genero actualizado correctamente",
            "data" => $gender,
        ];
    }

    /**
     * Elimina un género, validando primero que no esté en uso por ningún perfil.
     * @param int|string $id
     * @return array
     */
    public function delete($id)
    {
        $gender = Gender::find($id);

        if (!$gender){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }
        
        // Verificación de integridad: No permite eliminar si existen perfiles vinculados
        if ($gender->profile->count()) {
            return [
                "error" => true,
                "code" => 409, // Conflict: Indica que la petición no se puede completar por conflictos
                "message" => "No se puede eliminar el genero porque tiene registros relacionados",
            ];
        }

        $originalData = $gender->toArray();

        $gender->delete();

        // Auditoría del borrado
        $gender->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Eliminado',
            'status_old'     => $originalData['is_active'] ? "Activo" : "Inactivo",
            'status_new'     => null
            ]);
        
        return [
            "error" => false,
            "code" => 200,
            "message" => "Genero eliminado exitosamente",
        ];
    }

    public function history($id)
    {
        $gender = Gender::find($id);

        if (!$gender) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Genero no encontrado",
            ];
        }

        // Obtenemos todas las auditorías ordenadas por fecha descendente
        $history = $gender->audits()
            ->orderBy('date_time', 'desc')
            ->get()
            ->map(function($audit) {
                return [
                    'date_time' => $audit->date_time,
                    'user_name' => $audit->user_name,
                    'rol' => $audit->rol_name,
                    'action_execute' => $audit->action_execute,
                    'status_old' => $audit->status_old,
                    'status_new' => $audit->status_new,
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