<?php

namespace App\Http\Controllers\API\Notification;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\StoreNotificationRequest;
use App\Http\Requests\Notification\UpdateNotificationRequest;
use App\Http\Requests\Notification\PartialUpdateNotificationRequest;
use App\Models\Notification\Notification;
use App\Services\Notification\NotificationService;
use App\Policies\AccessNotificationPolicy;

class NotificationController extends Controller
{
    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $response = $this->service->getAll();

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function show(string $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return ResponseFormatter::error(
                'Registro no encontrado',
                404
            );
        }

        // if (!(new AccessNotificationPolicy())->access($notification)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para ver esta notificación',
        //         403
        //     );
        // }

        $response = $this->service->getById($id);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function store(StoreNotificationRequest $request)
    {
        $data = $request->validated();

        $response = $this->service->create($data);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function update(UpdateNotificationRequest $request, string $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return ResponseFormatter::error(
                'Registro no encontrado',
                404
            );
        }

        // if (!(new AccessNotificationPolicy())->access($notification)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar esta notificación',
        //         403
        //     );
        // }

        $response = $this->service->update(
            $request->validated(),
            $id
        );

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function partialUpdate(PartialUpdateNotificationRequest $request,string $id)
     {
        $notification = Notification::find($id);

        if (!$notification) {
            return ResponseFormatter::error(
                'Registro no encontrado',
                404
            );
        }

        // if (!(new AccessNotificationPolicy())->access($notification)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar esta notificación',
        //         403
        //     );
        // }

        $response = $this->service->partialUpdate(
            $request->validated(),
            $id
        );

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }

    public function destroy(string $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return ResponseFormatter::error(
                'Registro no encontrado',
                404
            );
        }

        // if (!(new AccessNotificationPolicy())->access($notification)) {
        //     return ResponseFormatter::error(
        //         'Usted no tiene autorización para modificar esta notificación',
        //         403
        //     );
        // }

        $response = $this->service->delete($id);

        if ($response['error']) {
            return ResponseFormatter::error(
                $response['message'],
                $response['code']
            );
        }

        return ResponseFormatter::success(
            $response['message'],
            $response['code'],
            $response['data'] ?? []
        );
    }
}
