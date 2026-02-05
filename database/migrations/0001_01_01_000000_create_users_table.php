<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones (Crea las tablas).
     */
    public function up(): void
    {
        // Creación de la tabla de usuarios principales
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ID autoincremental (Primary Key)
            $table->string('email', 255)->unique(); // Correo electrónico único para cada usuario
            $table->string('password'); // Contraseña encriptada
            $table->rememberToken(); // Token para la opción "Recordarme" al iniciar sesión
            $table->timestamps(); // Crea las columnas 'created_at' y 'updated_at'
        });

        // Tabla para gestionar la recuperación de contraseñas
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // El email es la clave primaria aquí
            $table->string('token'); // El token de seguridad enviado por correo
            $table->timestamp('created_at')->nullable(); // Fecha de creación del token
        });

        // Tabla para manejar sesiones de usuario en la base de datos (Database Driver)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID único de la sesión
            $table->foreignId('user_id')->nullable()->index(); // ID del usuario (si está autenticado)
            $table->string('ip_address', 45)->nullable(); // Dirección IP del visitante
            $table->text('user_agent')->nullable(); // Información del navegador/dispositivo
            $table->longText('payload'); // Datos de la sesión (encriptados)
            $table->integer('last_activity')->index(); // Timestamp de la última actividad del usuario
        });
    }

    /**
     * Revierte las migraciones (Elimina las tablas).
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};