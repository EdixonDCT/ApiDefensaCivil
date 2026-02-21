<?php
    namespace App\Services\Audit;

    use App\Models\User\User;
    use App\Models\Audit\Audit;
    use App\Models\FamilyPlan\FamilyPlan;
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;

    
    class AuditService
    {
        public function DashBoardAdmin()
        {
            // 🔹 1. RESUMEN USUARIOS
            $summaryData = User::selectRaw("
                    SUM(CASE WHEN state_user_id = 1 THEN 1 ELSE 0 END) as active,
                    SUM(CASE WHEN state_user_id = 2 THEN 1 ELSE 0 END) as inactive,
                    SUM(CASE WHEN state_user_id = 3 THEN 1 ELSE 0 END) as request
                ")
                ->first();

            $summary = [
                "active"   => (int) ($summaryData->active ?? 0),
                "inactive" => (int) ($summaryData->inactive ?? 0),
                "request"  => (int) ($summaryData->request ?? 0),
            ];

            // 🔹 2. ROLES
            $rolesData = DB::table('model_has_roles')
                ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->selectRaw("
                    SUM(CASE WHEN roles.name = 'Administrador' THEN 1 ELSE 0 END) as admin,
                    SUM(CASE WHEN roles.name = 'Supervisor' THEN 1 ELSE 0 END) as supervisor,
                    SUM(CASE WHEN roles.name = 'Voluntario' THEN 1 ELSE 0 END) as volunteer
                ")
                ->first();

            $rols = [
                "admin"      => (int) ($rolesData->admin ?? 0),
                "supervisor" => (int) ($rolesData->supervisor ?? 0),
                "volunteer"  => (int) ($rolesData->volunteer ?? 0),
            ];

            // 🔹 3. CAMBIOS ÚLTIMOS 6 MESES (AUDIT)
            $now = Carbon::now();
            $startDate = $now->copy()->subMonths(5)->startOfMonth();
            $endDate = $now->copy()->endOfMonth();

            $rawAudit = Audit::where('historiable_type', '!=', User::class)
                ->where('historiable_type', '!=', FamilyPlan::class)
                ->whereBetween('date_time', [$startDate, $endDate])
                ->selectRaw("
                    DATE_FORMAT(date_time, '%Y-%m') as 'year_month',
                    COUNT(*) as total
                ")
                ->groupBy(DB::raw("DATE_FORMAT(date_time, '%Y-%m')"))
                ->orderBy('year_month')
                ->get()
                ->keyBy('year_month');

            $monthly = [];
            Carbon::setLocale('es');
            for ($i = 5; $i >= 0; $i--) {

                $date = Carbon::now()->subMonths($i);
                $key = $date->format('Y-m');

                $monthly[] = [
                    "month" => $date->translatedFormat('F'),
                    "total" => (int) ($rawAudit[$key]->total ?? 0)
                ];
            }

            $historyGeneral = Audit::with('historiable')
            ->whereNotIn('historiable_type', [
                FamilyPlan::class,
                Member::class,
                User::class
            ])
            ->latest('date_time')
            ->take(10)
            ->get()
            ->map(fn($audit) => $this->formatAudit($audit));

            $historyMembers = Audit::with('historiable')
            ->where('historiable_type', User::class)
            ->latest('date_time')
            ->take(10)
            ->get()
            ->map(fn($audit) => $this->formatAudit($audit));

            // 🔹 RESPUESTA FINAL
            return [
                "error" => false,
                "code" => 200,
                "message" => "Dashboard obtenido correctamente",
                "data" => [
                    "summary" => $summary,
                    "rols" => $rols,
                    "monthly_changes" => $monthly,
                    "history_general" => $historyGeneral,
                    "history_members" => $historyMembers
                ]
            ];
        }

        private function formatAudit($audit)
        {
            return [
                'date_time'      => $audit->date_time,
                'user_name'      => $audit->user_name,
                'rol'            => $audit->rol_name,
                'action_execute' => $audit->action_execute,
                'status_old'     => $audit->status_old,
                'status_new'     => $audit->status_new,
                // 'historiable_id' => $audit->historiable_id,
                // 'tabla'          => class_basename($audit->historiable_type),
                'name_model'  => $audit->historiable->name 
                                    ?? $audit->historiable->profile->names.' '.$audit->historiable->profile->last_names
            ];
        }
    }


