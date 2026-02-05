<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Añade la columna 'description' a la tabla de permisos existente.
     */
    public function up(): void
    {
        // Usamos Schema::table para modificar una tabla ya creada anteriormente
        Schema::table('permissions', function (Blueprint $table) {
            /**
             * Añade una columna de texto llamada 'description'.
             * nullable(): Permite que el campo esté vacío, ya que es información extra.
             * Ejemplo: Si el permiso es 'edit-users', la descripción podría ser 
             * "Permite al administrador modificar datos básicos de los usuarios".
             */
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la columna 'description' en caso de revertir la migración.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            // Se elimina específicamente la columna creada para dejar la tabla como estaba
            $table->dropColumn('description');
        });
    }
};