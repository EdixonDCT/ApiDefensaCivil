<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     * Crea la tabla kinships para almacenar los tipos de parentesco.
     */
    public function up(): void
    {
        Schema::create('kinships', function (Blueprint $table) {

            /**
             * Clave primaria autoincremental.
             */
            $table->id();

            /**
             * Nombre del parentesco.
             * Ejemplos: Father, Mother, Brother, Sister, Uncle, Cousin
             * - Longitud máxima de 30 caracteres
             * - Debe ser único para evitar duplicados
             */
            $table->string('name', 30)->unique();

            /**
             * Estado lógico del parentesco.
             * Permite habilitar o deshabilitar sin eliminar registros.
             */
            
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     * Elimina la tabla kinships si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('kinships');
    }
};
