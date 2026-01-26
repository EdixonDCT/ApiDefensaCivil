<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ejecuta la creación de la tabla 'sectionals'.
     */
    public function up(): void
    {
        // Se crea la tabla para almacenar las diferentes seccionales o sedes
        Schema::create('sectionals', function (Blueprint $table) {
            // ID único autoincremental (llave primaria)
            $table->id();

            // Nombre de la seccional con un límite de 50 caracteres
            // unique() asegura que no existan dos seccionales con el mismo nombre
            $table->string('name', 50)->unique();

            // Estado de la seccional (Activa/Inactiva)
            // boolean: 1 para activo (true), 0 para inactivo (false)
            // default(1): Por defecto, toda seccional nueva se crea como activa
            $table->boolean('is_active')->default(1);

            // Columnas 'created_at' y 'updated_at' para control de auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'sectionals' en caso de revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectionals');
    }
};