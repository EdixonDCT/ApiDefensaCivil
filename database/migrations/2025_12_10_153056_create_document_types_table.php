<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'document_types' para clasificar los documentos de identidad.
     */
    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {
            // ID único autoincremental (Llave Primaria)
            $table->id();

            // Nombre completo del tipo de documento (ej: 'Cédula de Ciudadanía')
            // unique() evita que se dupliquen los nombres
            $table->string('name', 50)->unique();

            // Abreviatura del documento (ej: 'CC', 'CE', 'NIT', 'PSP')
            // Se limita a 10 caracteres para optimizar espacio y se marca como único
            $table->string('acronym', 10)->unique();

            // Estado del tipo de documento (1 = Activo, 0 = Inactivo)
            // Permite deshabilitar un tipo de documento sin borrar el historial
            $table->boolean('is_active')->default(1);

            // Columnas para control de auditoría: created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'document_types' de la base de datos.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};