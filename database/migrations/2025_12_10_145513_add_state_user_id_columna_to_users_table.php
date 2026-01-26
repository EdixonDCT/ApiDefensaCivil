<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Modifica la tabla existente para añadir la relación.
     */
    public function up(): void
    {
        // Usamos Schema::table (en lugar de create) para editar la tabla 'users'
        Schema::table('users', function (Blueprint $table) {
            /**
             * foreignId: Crea una columna de tipo BIGINT para el ID del estado.
             * constrained: Le dice a Laravel que esta columna es una llave foránea.
             * Por convención, Laravel busca la tabla 'state_users' y la columna 'id'.
             */
            $table->foreignId('state_user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     * Revierte los cambios en la tabla 'users'.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Primero debemos eliminar la restricción de llave foránea (el candado)
            $table->dropForeign(['state_user_id']);
            
            // Luego eliminamos la columna físicamente
            $table->dropColumn('state_user_id');
        });
    }
};