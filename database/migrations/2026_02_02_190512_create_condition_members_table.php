<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla 'condition_members' que relaciona a los miembros
     * con sus tipos de condición y detalles específicos.
     */
    public function up(): void
    {
        Schema::create('condition_members', function (Blueprint $table) {
            $table->id(); // ID auto-incremental de la tabla

            // Relación con el tipo de condición (FK a condition_types)
            $table->foreignId('condition_type_id')->constrained();

            // Relación con el miembro (FK a members)
            $table->foreignId('member_id')->constrained();

            // Nombre de la condición (por ejemplo: 'Gripe', 'Diabetes')
            $table->string('name', 50);

            // Dosis o detalles adicionales (opcional)
            $table->string('dose', 255)->nullable();

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla 'condition_members' si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('condition_members');
    }
};
