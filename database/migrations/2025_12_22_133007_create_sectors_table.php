<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'sectors' para clasificar organizaciones o usuarios por sector.
     */
    public function up(): void
    {
        // Se define la estructura para el catálogo de sectores
        Schema::create('sectors', function (Blueprint $table) {
            // ID único autoincremental (Llave Primaria)
            $table->id();

            // Nombre del sector (ej: 'Salud', 'Educación', 'Financiero')
            // Se limita a 50 caracteres y se marca como unique() para evitar duplicados
            $table->string('name', 50)->unique();

            // Estado del registro: 1 para Activo, 0 para Inactivo
            // Útil para deshabilitar sectores sin borrar datos históricos
            $table->boolean('is_active')->default(1);

            // Crea automáticamente las columnas created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'sectors' de la base de datos.
     */
    public function down(): void
    {
        // Borra la tabla solo si existe para evitar errores al revertir
        Schema::dropIfExists('sectors');
    }
};