<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'departments' para gestionar los nombres o números de unidades habitacionales.
     */
    public function up(): void
    {
        // Se define la estructura de la tabla de apartamentos
        Schema::create('departments', function (Blueprint $table) {
            // ID único autoincremental (Llave Primaria)
            $table->id();

            // Nombre o identificador del apartamento (ej: '101', 'Penthouse', 'A-202')
            // Se limita a 50 caracteres y se marca como único para evitar registros repetidos
            $table->string('name', 50)->unique();   

            // Columnas de auditoría: created_at (fecha de creación) y updated_at (fecha de edición)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'departments' de la base de datos.
     */
    public function down(): void
    {
        // Borra la tabla solo si existe para evitar errores durante un rollback
        Schema::dropIfExists('departments');
    }
};