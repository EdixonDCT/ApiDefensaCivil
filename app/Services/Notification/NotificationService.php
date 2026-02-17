<?php

namespace App\Services\Notification;

use App\Models\Notification\Notification;

class NotificationService
{
    public function __construct()
    {
        //
    }

    public static function getAll()
    {
        $notifications = Notification::all();

        if ($notifications->isEmpty()) {
            return [
                "error"   => false,
                "code"    => 200,
                "message" => "No hay registros de notificaciones",
                "data"    => $notifications,
            ];
        }

        return [
            "error"   => false,
            "code"    => 200,
            "message" => "Registros de notificaciones obtenidos exitosamente",
            "data"    => $notifications,
        ];
    }

    public function getById($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return [
                "error"   => true,
                "code"    => 404,
                "message" => "Notificación no encontrada",
            ];
        }

        return [
            "error"   => false,
            "code"    => 200,
            "message" => "Notificación obtenida exitosamente",
            "data"    => $notification,
        ];
    }

    public function create(array $data)
    {
        $notification = Notification::create($data);

        return [
            "error"   => false,
            "code"    => 201,
            "message" => "Notificación creada exitosamente",
            "data"    => $notification,
        ];
    }

    public function update(array $data, $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return [
                "error"   => true,
                "code"    => 404,
                "message" => "Notificación no encontrada",
            ];
        }

        $notification->update($data);

        return [
            "error"   => false,
            "code"    => 200,
            "message" => "Notificación actualizada exitosamente",
            "data"    => $notification,
        ];
    }

    public function partialUpdate(array $data, $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return [
                "error"   => true,
                "code"    => 404,
                "message" => "Notificación no encontrada",
            ];
        }

        $notification->update($data);

        return [
            "error"   => false,
            "code"    => 200,
            "message" => "Notificación actualizada parcialmente exitosamente",
            "data"    => $notification,
        ];
    }

    public function delete($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return [
                "error"   => true,
                "code"    => 404,
                "message" => "Notificación no encontrada",
            ];
        }

        $notification->delete();

        return [
            "error"   => false,
            "code"    => 200,
            "message" => "Notificación eliminada exitosamente",
        ];
    }
}
