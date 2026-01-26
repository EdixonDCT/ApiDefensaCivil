<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'actions' para tipificar las actividades del sistema.
     */
    public function up(): void
    {
        // Se define la tabla que servirá como catálogo de acciones
        Schema::create('actions', function (Blueprint $table) {
            // ID único autoincremental (Llave Primaria)
            $table->id();

            // Nombre de la acción (ej: 'Asesoría Jurídica', 'Entrega de Alimentos')
            // Se limita a 50 caracteres para mantener la eficiencia en los índices
            $table->string('name', 50);

            // Columnas de auditoría para rastrear creación y cambios
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'actions'.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};