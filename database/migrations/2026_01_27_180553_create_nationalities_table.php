<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla nationalities para almacenar el catálogo de nacionalidades.
     */
    public function up(): void
    {
        Schema::create('nationalities', function (Blueprint $table) {

            /**
             * Clave primaria autoincremental.
             */
            $table->id();

            /**
             * Nombre de la nacionalidad.
             * - Longitud máxima de 50 caracteres.
             * - Debe ser único para evitar registros duplicados.
             * Ejemplos: Colombiana, Mexicana, Española.
             */
            $table->string('name', 50)->unique();

            /**
             * Indica si la nacionalidad está activa en el sistema.
             * - true (1): Activa
             * - false (0): Inactiva
             * Se usa para control administrativo sin eliminar registros.
             */
            $table->boolean('is_active')->default(true);

            /**
             * Campos estándar de auditoría:
             * - created_at
             * - updated_at
             */
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla nationalities si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('nationalities');
    }
};
