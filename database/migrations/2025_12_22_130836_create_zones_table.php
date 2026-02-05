<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'zones' para clasificar áreas geográficas o sectores.
     */
    public function up(): void
    {
        // Se define la estructura de la tabla de zonas
        Schema::create('zones', function (Blueprint $table) {
            // ID único autoincremental (Llave Primaria)
            $table->id();

            // Nombre de la zona (ej: 'Norte', 'Sur', 'Centro', 'Occidente')
            // Se limita a 50 caracteres para eficiencia y se marca como único para evitar duplicados
            $table->string('name', 50)->unique();

            // Columnas de auditoría: created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'zones' de la base de datos.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};