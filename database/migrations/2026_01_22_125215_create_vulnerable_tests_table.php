<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'vulnerable_tests' para registrar las respuestas de las familias.
     */
    public function up(): void
    {
        Schema::create('vulnerable_tests', function (Blueprint $table) {
            // ID único del registro de respuesta
            $table->id();

            // Relación con la pregunta específica del banco de preguntas
            $table->foreignId('vulnerable_question_id')->constrained();

            // Relación con el plan familiar al que se le aplica la evaluación
            $table->foreignId('family_plan_id')->constrained();

            /** * Respuesta a la pregunta (tipo booleano)
             * 0 = Falso / No
             * 1 = Verdadero / Sí
             * Por defecto se establece en 0.
             */
            $table->boolean('answer')->default(0);

            // Registra cuándo se respondió la pregunta y si hubo actualizaciones
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vulnerable_tests');
    }
};