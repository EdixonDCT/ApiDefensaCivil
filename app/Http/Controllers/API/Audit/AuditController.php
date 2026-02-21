<?php

namespace App\Http\Controllers\API\Audit;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Services\Audit\AuditService;

class AuditController extends Controller
{
    protected $service;

    public function __construct(AuditService $service)
    {
        $this->service = $service;
    }

    /**
     * Resumen de estados de usuarios
     */
    public function dashBoardAdmin()
    {
        $response = $this->service->DashBoardAdmin();

        if ($response['error']) {
            return ResponseFormatter::error($response['message'],$response['code']);
        }

        return ResponseFormatter::success($response['message'],$response['code'],$response['data'] ?? []
        );
    }
}
