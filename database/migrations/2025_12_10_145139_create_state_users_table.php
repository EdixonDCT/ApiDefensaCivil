<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ejecuta la creación de la tabla 'state_users'.
     */
    public function up(): void
    {
        // Crea la estructura de la tabla para definir los estados posibles de un usuario
        Schema::create('state_users', function (Blueprint $table) {
            // ID autoincremental que servirá como llave primaria (Primary Key)
            $table->id();

            // Nombre del estado (ejemplo: 'Activo', 'Inactivo', 'Suspendido', 'Pendiente')
            // Se define como 'unique' para que no existan dos estados con el mismo nombre
            $table->string('name')->unique();

            // Crea las columnas 'created_at' y 'updated_at' para llevar registro de tiempos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla si decides deshacer la migración.
     */
    public function down(): void
    {
        // Borra la tabla 'state_users' solo si existe en la base de datos
        Schema::dropIfExists('state_users');
    }
};