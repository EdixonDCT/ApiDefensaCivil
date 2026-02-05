<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones para el sistema de colas y trabajos.
     */
    public function up(): void
    {
        // Tabla para los trabajos (Jobs) pendientes de ejecución
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();      // Nombre de la cola (ej: 'default', 'emails')
            $table->longText('payload');           // El objeto del trabajo serializado (datos necesarios)
            $table->unsignedTinyInteger('attempts'); // Cuántas veces se ha intentado ejecutar
            $table->unsignedInteger('reserved_at')->nullable(); // Cuándo fue "apartado" por un worker
            $table->unsignedInteger('available_at'); // Cuándo debe estar disponible para ejecutarse
            $table->unsignedInteger('created_at');   // Fecha de creación (timestamp simple)
        });

        // Tabla para manejar grupos de trabajos (Batching)
        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();         // ID único del lote de trabajos
            $table->string('name');                  // Nombre descriptivo del lote
            $table->integer('total_jobs');           // Cantidad total de tareas en este lote
            $table->integer('pending_jobs');         // Cuántas faltan por terminar
            $table->integer('failed_jobs');          // Cuántas han fallado
            $table->longText('failed_job_ids');      // IDs de los trabajos que fallaron
            $table->mediumText('options')->nullable(); // Configuración (ej: qué hacer al terminar)
            $table->integer('cancelled_at')->nullable(); // Si el lote fue cancelado
            $table->integer('created_at');           
            $table->integer('finished_at')->nullable(); // Cuándo se completó todo el lote
        });

        // Tabla para registrar los trabajos que fallaron definitivamente
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();        // Identificador único universal
            $table->text('connection');              // Conexión usada (ej: database, redis)
            $table->text('queue');                   // En qué cola estaba
            $table->longText('payload');             // Datos del trabajo que falló
            $table->longText('exception');           // El error/excepción que causó el fallo
            $table->timestamp('failed_at')->useCurrent(); // Momento exacto del error
        });
    }

    /**
     * Elimina las tablas relacionadas con las colas.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};