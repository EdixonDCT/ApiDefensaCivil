<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla blood_groups que almacena el catálogo de grupos sanguíneos.
     */
    public function up(): void
    {
        Schema::create('blood_groups', function (Blueprint $table) {

            /**
             * Clave primaria autoincremental.
             */
            $table->id();

            /**
             * Nombre del grupo sanguíneo.
             * - Longitud máxima de 3 caracteres (ej: A+, O-, AB+)
             * - Debe ser único para evitar duplicados.
             */
            $table->string('name', 3)->unique();

            /**
             * Campos estándar de control:
             * - created_at
             * - updated_at
             */
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla blood_groups si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_groups');
    }
};
