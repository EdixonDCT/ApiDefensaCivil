<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones (Crea la tabla para tokens de acceso personal).
     */
    public function up(): void
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            
            // Crea dos columnas: tokenable_id y tokenable_type.
            // Esto permite que el token pertenezca a un Usuario, un Administrador, o cualquier otro modelo.
            $table->morphs('tokenable'); 
            
            $table->text('name'); // Nombre del token (ej: "Mi App Móvil" o "Token de Postman")
            $table->string('token', 64)->unique(); // El hash del token real para validar la sesión
            $table->text('abilities')->nullable(); // Permisos específicos (ej: ["post:create", "user:update"])
            $table->timestamp('last_used_at')->nullable(); // Registro de cuándo se usó por última vez
            $table->timestamp('expires_at')->nullable()->index(); // Fecha de expiración del token
            $table->timestamps(); // Fecha de creación y actualización del registro
        });
    }

    /**
     * Revierte las migraciones (Elimina la tabla).
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};