<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla 'condition_types', que almacena
     * los distintos tipos de condición disponibles en el sistema.
     */
    public function up(): void
    {
        Schema::create('condition_types', function (Blueprint $table) {
            $table->id(); // ID auto-incremental de cada tipo de condición

            // Nombre del tipo de condición (máx 50 caracteres)
            // Ejemplos: 'Enfermedad', 'Alergia', 'Discapacidad'
            $table->string('name', 50);

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla 'condition_types' si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('condition_types');
    }
};
