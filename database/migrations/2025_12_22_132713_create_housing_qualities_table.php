<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'housing_qualities' para clasificar los tipos o calidades de vivienda.
     */
    public function up(): void
    {
        // Se define la estructura para categorizar las condiciones de vivienda
        Schema::create('housing_qualities', function (Blueprint $table) {
            // ID único autoincremental (Llave Primaria)
            $table->id();

            // Nombre de la calidad o tipo de vivienda (ej: 'Excelente', 'Regular', 'Vivienda Propia')
            // El límite de 50 caracteres mantiene la base de datos ligera y rápida
            $table->string('name', 50)->unique();

            // Estado de disponibilidad: 1 para activo, 0 para inactivo
            // Permite deshabilitar opciones sin afectar registros antiguos
            $table->boolean('is_active')->default(1);

            // Columnas de auditoría: created_at (creación) y updated_at (edición)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'housing_qualities' de la base de datos.
     */
    public function down(): void
    {
        // Borra la tabla solo si existe para evitar errores en el rollback
        Schema::dropIfExists('housing_qualities');
    }
};