<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla de tokens temporales para verificación de identidad
     * antes de realizar operaciones sobre datos sensibles del usuario.
     *
     * Acciones soportadas mediante la columna 'action':
     * - 'change_email'    → cambio de correo electrónico
     * - 'change_phone'    → cambio de teléfono (futuro)
     * - 'change_document' → cambio de documento (futuro)
     *
     * Los tokens son de un solo uso y tienen TTL corto (10 min).
     * Se limpian automáticamente con model:prune.
     */
    public function up(): void
    {
        Schema::create('account_verification_tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Llave foranea del usuario registrado
            $table->foreign('user_id')->references('id')->on('users'); // Llave foranea del usuario registrado
            $table->string('token');          // Hash del token raw
            $table->string('action');         // Acción sensible que protege
            $table->timestamp('expires_at');  // TTL explícito (10 min por defecto)
            $table->timestamps();

            // Índice compuesto para la consulta del middleware
            $table->index(['user_id', 'action']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_verification_tokens');
    }
};
