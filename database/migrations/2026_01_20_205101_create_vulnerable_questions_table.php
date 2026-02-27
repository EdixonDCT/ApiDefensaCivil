<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'vulnerable_questions' para gestionar el cuestionario de vulnerabilidad.
     */
    public function up(): void
    {
        // Se define la estructura para almacenar las preguntas de evaluación
        Schema::create('vulnerable_questions', function (Blueprint $table) {
            // ID único autoincremental (Llave Primaria)
            $table->id();

            // La pregunta o enunciado (ej: '¿Cuenta con acceso a agua potable?')
            // Se usa string para almacenar el texto de la pregunta
            $table->string('description');

            /** * Indica si la pregunta representa una señal de alerta o precaución.
             * boolean: 1 (Sí / Precaucion), 0 (No / Normal)
             */
            $table->boolean('question_caution');

            // Estado de la pregunta en el sistema
            // default(1): Por defecto, la pregunta se crea como activa
            $table->boolean('is_active')->default(1);

            // Columnas de auditoría: created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'vulnerable_questions' en caso de revertir cambios.
     */
    public function down(): void
    {
        Schema::dropIfExists('vulnerable_questions');
    }
};