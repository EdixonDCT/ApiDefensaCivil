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

    public function countUnreadByUser($user_id)
    {
        $count = Notification::where('user_id', $user_id)
            ->where('read', false)
            ->count();

        if ($count === 0) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay notificaciones no leídas",
                "data" => [
                    "unread_notifications" => 0
                ]
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Cantidad de notificaciones no leídas obtenida exitosamente",
            "data" => [
                "unread_notifications" => $count
            ]
        ];
    }

    public function getUnreadByUser($user_id)
    {
        $notifications = Notification::where('user_id', $user_id)
            ->where('read', false)
            ->latest()
            ->limit(3)
            ->get();

        if ($notifications->isEmpty()) {
            return [
                "error" => false,
                "code" => 200,
                "message" => "No hay notificaciones no leídas",
                "data" => []
            ];
        }

        return [
            "error" => false,
            "code" => 200,
            "message" => "Notificaciones no leídas obtenidas exitosamente",
            "data" => $notifications
        ];
    }

    public function getByUserId($user_id)
    {
        $paginator = Notification::where('user_id', $user_id)
            ->latest()
            ->paginate(10);

        $items = $paginator->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'user_id' => $item->user_id,
                'audit_id' => $item->audit_id,
                'is_read' => $item->is_read,
                'created_at' => $item->created_at,
            ];
        });

        return [
            "error"   => false,
            "code"    => 200,
            "message" => $items->isEmpty()
                ? "No hay notificaciones para este usuario"
                : "Notificaciones obtenidas exitosamente",
            "data"    => $items,
            "paginate" => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
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
