<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'cities' vinculada (según el código) a un apartamento.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            // ID único autoincremental para la ciudad
            $table->id();

            // Nombre de la ciudad (ej: 'Bogotá', 'Medellín')
            // Único para evitar nombres repetidos y limitado a 50 caracteres
            $table->string('name', 50)->unique();   

            /** * RELACIÓN ACTUAL:
             * Aquí estás diciendo que una CIUDAD pertenece a un APARTAMENTO.
             * Generalmente es al revés (un apartamento está en una ciudad).
             */
            $table->foreignId('apartment_id')->constrained();

            // Auditoría básica
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};