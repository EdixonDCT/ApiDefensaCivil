<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ejecuta la creación de las tablas de Roles y Permisos (Spatie).
     */
    public function up(): void
    {
        // 1. CARGA DE CONFIGURACIÓN: Se obtienen nombres de tablas y columnas del archivo config/permission.php
        $teams = config('permission.teams');
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';

        // Validaciones: Detiene la migración si no se encuentra el archivo de configuración
        throw_if(empty($tableNames), Exception::class, 'Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        throw_if($teams && empty($columnNames['team_foreign_key'] ?? null), Exception::class, 'Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');

        // 2. TABLA PERMISSIONS: Almacena las acciones (ej: 'edit-post', 'delete-user')
        Schema::create($tableNames['permissions'], static function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('name');       // Nombre del permiso
            $table->string('guard_name'); // Guard (web, api, etc.)
            $table->timestamps();

            $table->unique(['name', 'guard_name']); // Evita permisos duplicados en el mismo guard
        });

        // 3. TABLA ROLES: Almacena grupos de permisos (ej: 'admin', 'editor')
        Schema::create($tableNames['roles'], static function (Blueprint $table) use ($teams, $columnNames) {
            $table->bigIncrements('id'); 
            
            // Si el sistema usa equipos (teams), el rol pertenece a un equipo específico
            if ($teams || config('permission.testing')) { 
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('name'); 
            $table->string('guard_name');
            $table->timestamps();

            // Unicidad del nombre del rol según si hay equipos activos o no
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        // 4. TABLA MODEL_HAS_PERMISSIONS: Relaciona permisos directamente con un usuario (u otro modelo)
        Schema::create($tableNames['model_has_permissions'], static function (Blueprint $table) use ($tableNames, $columnNames, $pivotPermission, $teams) {
            $table->unsignedBigInteger($pivotPermission); // ID del permiso

            // Estas dos columnas crean la relación polimórfica (para cualquier modelo)
            $table->string('model_type'); 
            $table->unsignedBigInteger($columnNames['model_morph_key']); 
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign($pivotPermission)
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade'); // Si se borra el permiso, se borra la relación

            // Define la clave primaria según la configuración de equipos
            if ($teams) {
                $table->primary([$columnNames['team_foreign_key'], $pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                $table->primary([$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }

        });

        // 5. TABLA MODEL_HAS_ROLES: Relaciona usuarios (u otros modelos) con roles asignados
        Schema::create($tableNames['model_has_roles'], static function (Blueprint $table) use ($tableNames, $columnNames, $pivotRole, $teams) {
            $table->unsignedBigInteger($pivotRole); // ID del rol

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign($pivotRole)
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            if ($teams) {
                $table->primary([$columnNames['team_foreign_key'], $pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                $table->primary([$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        // 6. TABLA ROLE_HAS_PERMISSIONS: Define qué permisos tiene asignados cada rol
        Schema::create($tableNames['role_has_permissions'], static function (Blueprint $table) use ($tableNames, $pivotRole, $pivotPermission) {
            $table->unsignedBigInteger($pivotPermission);
            $table->unsignedBigInteger($pivotRole);

            $table->foreign($pivotPermission)
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign($pivotRole)
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([$pivotPermission, $pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        // 7. LIMPIEZA DE CACHÉ: Borra la caché de permisos para que los cambios se apliquen de inmediato
        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     * Borra todas las tablas creadas en el orden correcto.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        throw_if(empty($tableNames), Exception::class, 'Error: config/permission.php not found...');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
};