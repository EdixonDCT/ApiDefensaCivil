<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'organizations' en la base de datos.
     */
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            // ID único para cada organización (Primary Key)
            $table->id();

            // Nombre de la organización limitado a 50 caracteres
            // unique() impide que existan dos organizaciones con el mismo nombre
            $table->string('name', 50)->unique();

            // Estado de la organización (1 = Activa, 0 = Inactiva)
            // Se define como activa por defecto al ser creada
            $table->boolean('is_active')->default(1);

            /**
             * RELACIÓN: Cada organización pertenece a una seccional.
             * foreignId: Crea la columna 'sectional_id'.
             * constrained: Crea el vínculo de integridad con la tabla 'sectionals'.
             */
            $table->foreignId('sectional_id')->constrained();

            // Registra automáticamente la fecha de creación y última actualización
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'organizations' por completo.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};