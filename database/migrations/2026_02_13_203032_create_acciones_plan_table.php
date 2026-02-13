<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acciones_plan', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('tipo_accion_id')->constrained('action_types');

            $table->string('descripcion', 255);

            $table->foreignId('integrante_id')->constrained('members');

            $table->foreignId('plan_de_accion_id')->constrained('action_plans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acciones_plan');
    }
};
