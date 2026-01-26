<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'profiles' para almacenar la información personal de los usuarios.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            // ID único del perfil
            $table->id();

            // Relación 1:1 con la tabla 'users' (el dueño de este perfil)
            $table->foreignId('user_id')->constrained();

            // Nombres y Apellidos limitados a 50 caracteres cada uno
            $table->string('names', 50);
            $table->string('last_names', 50);

            // Fecha de nacimiento (formato YYYY-MM-DD)
            $table->date('birth_date');

            // Relación con el tipo de documento (CC, TI, Pasaporte, etc.)
            $table->foreignId('document_type_id')->constrained();

            // Número de identidad (máximo 20 caracteres)
            $table->string('document_number', 20);

            // Teléfono de contacto (único para evitar duplicidad de cuentas)
            $table->string('phone', 10)->unique();

            // Relación con la tabla de géneros
            $table->foreignId('gender_id')->constrained();

            // Relación con la organización a la que pertenece el usuario
            $table->foreignId('organization_id')->constrained();

            // Auditoría: created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'profiles'.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};