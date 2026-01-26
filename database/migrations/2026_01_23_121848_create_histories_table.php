<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'histories' para el seguimiento de actividades.
     */
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            // ID único del registro histórico
            $table->id();

            // RELACIONES CLAVE:
            // El usuario (funcionario/admin) que realizó la acción
            $table->foreignId('user_id')->constrained();

            // El plan familiar sobre el cual se ejecutó la acción
            $table->foreignId('family_plan_id')->constrained();

            // El tipo de acción realizada (referencia a la tabla 'actions')
            $table->foreignId('action_id')->constrained();

            // DATOS TEMPORALES:
            // Fecha específica de la actividad (independiente del timestamp de creación)
            $table->date('date')->nullable();

            // Hora específica de la actividad
            $table->time('time')->nullable();

            // Auditoría del sistema (created_at y updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};