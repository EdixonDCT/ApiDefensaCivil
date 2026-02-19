<?php

namespace App\Services\User;

use App\Models\User\User;
use Illuminate\support\Arr;

/**
 * Servicio para la gestión de cuentas de usuario.
 * Maneja las credenciales y la vinculación con la tabla de perfiles.
 */
class UserService
{
    /**
     * Obtiene la lista de todos los usuarios (credenciales).
     */
    public static function getAll()
    {
        $user = User::all();

        if ($user->isEmpty()){
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay usuarios registrados",
                "data" => $user,
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuarios obtenidos exitosamente",
            "data" => $user,
        ];
    }

    /**
     * Obtiene un usuario específico por su ID.
     */
    public function getById($id)
    {
        $user = User::with([
                        'profile.gender',
                        'profile.documentType',
                        'profile.organization.sectional'
                    ])
                    ->where('id', $id)
                    ->first();

        if (!$user) {
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario obtenido exitosamente",
            "data" => $user,
        ];
    }


    public function getRequests()
    {
        $paginator = User::with(['profile.organization', 'profile.organization.sectional', 'profile.documentType'])
                    ->where('state_user_id', 3)->paginate(10);

        $items = $paginator->getCollection()->transform(function ($item) {
            return [
                "id" => $item->id,
                "full_name" => $item->profile->names.' '.$item->profile->last_names,
                "email" => $item->email,
                "organization" => $item->profile->organization->name,
                "sectional" => $item->profile->organization->sectional->name,
                "document_number" => $item->profile->document_number.' '.$item->profile->documentType->acronym,
            ];
        });
        
        return [
            "error" => false,
            "code" => 200,
            "message" => $items->isEmpty()
                ? "No hay peticiones de usuarios para acceder al sistema"
                : "Peticiones de usuarios para acceder al sistema obtenidos exitosamente",
            "data"    => $items,
            'paginate' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
        ];
    }

    /**
     * Crea un nuevo usuario.
     * Importante: Los datos deben incluir email, password (hasheado) y state_user_id.
     */
    public function create(array $data)
    {
        $user = User::create($data);

        return [
            "error" => false,
            "code" => 201,
            "message" => "Usuario creado exitosamente",
            "data" => $user,
        ];
    }

    /**
     * Actualización total de la cuenta de usuario.
     */
    public function update(array $data, $id)
    {
        $user = User::find($id);

        if (!$user){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        $user->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado exitosamente",
            "data" => $user,
        ];
    }

    /**
     * Actualización parcial (ej. cambio de contraseña o cambio de estado).
     */
    public function partialUpdate(array $data,$id)
    {
        $user = User::find($id);

        if (!$user){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }

        $user->update($data);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Usuario actualizado parcialmente exitosamente",
            "data" => $user,
        ];
    }

    public function changeStatus(array $data,$id)
    {
        $user = User::with(['stateUser'])->find($id);

        if (!$user){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Usuario no encontrado",
            ];
        }
        
        $oldStatus = $user->stateUser->name;
        $user->update($data);
        $user->refresh()->load('stateUser');
        $newStatus = $user->stateUser->name;    

        $user->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => $oldStatus == 'Peticion' ? 'Aprobacion Peticion' : 'Cambio de Estado',
            'status_old'     => $oldStatus,
            'status_new'     => $user->stateUser->name,
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Aprobacion de usuario realizada exitosamente",        ];
    }
    /**
     * Elimina el usuario validando que no tenga un perfil asociado.
     * Si el perfil existe, se recomienda eliminar primero el perfil o usar soft deletes.
     */
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user){
            return [
                "error" => true,
                "code" => 404,
                "message" => "Peticion no encontrada",
            ];
        }
        if ($user->state_user_id !== 3)
        {
            return [
                "error" => true,
                "code" => 404,
                "message" => "El usuario ya fue aprobado no se puede eliminar",
            ];
        }
        // Validación de integridad: Un usuario no puede ser borrado si tiene un perfil humano activo
        $profile = $user->profile;
        
        $profile->delete();

        $user->delete();
        $user->audits()->create([
            'user_name'      => auth()->user()->profile->names . " " . auth()->user()->profile->last_names,
            'rol_name'       => auth()->user()->getRoleNames()->first(),
            'date_time'      => now(),
            'action_execute' => 'Rechazar Peticion',
            'status_old'     => 'Peticion',
            'status_new'     => 'Rechazado y Eliminado',
        ]);

        return [
            "error" => false,
            "code" => 200,
            "message" => "Peticion eliminada exitosamente",
        ];
    }
}