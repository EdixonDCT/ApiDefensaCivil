<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'genders' para definir las opciones de género en el sistema.
     */
    public function up(): void
    {
        // Definición de la tabla de géneros
        Schema::create('genders', function (Blueprint $table) {
            // ID único autoincremental (Llave Primaria)
            $table->id();

            // Nombre del género (ej: 'Masculino', 'Femenino', 'No binario', 'Prefiero no decirlo')
            // El límite de 50 caracteres es eficiente y el unique() evita duplicidad
            $table->string('name', 50)->unique();

            // Estado de disponibilidad del registro
            // Por defecto activo (1), permite desactivar opciones sin borrar datos históricos
            $table->boolean('is_active')->default(1);

            // Registra automáticamente created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'genders' por completo.
     */
    public function down(): void
    {
        Schema::dropIfExists('genders');
    }
};