<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Se ejecuta cuando corres php artisan migrate
     * Aquí se crea la tabla
     */
    public function up(): void
    {
        Schema::create('family_members', function (Blueprint $table) {

            // ID principal de la tabla
            $table->id();

            // Relación con la tabla family_plans
            // Crea family_plan_id y lo enlaza como foreign key
            $table->foreignId('family_plan_id')->constrained();

            // Relación con la tabla members
            // Crea member_id y lo enlaza como foreign key
            $table->foreignId('member_id')->constrained();

            // created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Se ejecuta cuando haces rollback
     * php artisan migrate:rollback
     */
    public function down(): void
    {
        // Elimina la tabla family_members
        Schema::dropIfExists('family_members');
    }
};
