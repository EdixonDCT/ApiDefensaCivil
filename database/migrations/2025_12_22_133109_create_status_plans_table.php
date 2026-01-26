<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'status_plans' para definir los posibles estados de un plan.
     */
    public function up(): void
    {
        // Se crea la tabla que servirá de catálogo para los estados de planes
        Schema::create('status_plans', function (Blueprint $table) {
            // ID único autoincremental (Llave Primaria)
            $table->id();

            // Nombre del estado (ej: 'Activo', 'Expirado', 'En Espera')
            // El límite de 50 caracteres optimiza el rendimiento de la base de datos
            // unique() garantiza que no existan nombres de estado repetidos
            $table->string('name', 50)->unique();    

            // Columnas para registrar la fecha de creación y actualización automática
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'status_plans' de la base de datos.
     */
    public function down(): void
    {
        // Borra la tabla solo si existe para evitar errores al revertir cambios
        Schema::dropIfExists('status_plans');
    }
};