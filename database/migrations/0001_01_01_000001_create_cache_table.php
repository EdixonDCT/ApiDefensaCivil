<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones para el sistema de caché.
     */
    public function up(): void
    {
        // Tabla para almacenar los datos de caché
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary(); // Identificador único de la información guardada
            $table->mediumText('value');      // El contenido o dato que estamos cacheando
            $table->integer('expiration');    // Tiempo (timestamp) en el que el dato deja de ser válido
        });

        // Tabla para manejar los "bloqueos" (locks) de caché
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary(); // Nombre del bloqueo
            $table->string('owner');          // Quién posee el bloqueo (ID del proceso/trabajo)
            $table->integer('expiration');    // Cuándo debe liberarse el bloqueo automáticamente
        });
    }

    /**
     * Revierte las migraciones (Elimina las tablas de caché).
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};