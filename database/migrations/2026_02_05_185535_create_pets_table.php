<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50);
            $table->string('breed', 50);
            $table->unsignedInteger('age');

            // Género del animal
            $table->foreignId('animal_gender_id')
                ->constrained('animal_genders');

            // Especie
            $table->foreignId('species_id')
                ->constrained('species');

            // Plan familiar (SIN cascada como pediste)
            $table->foreignId('family_plan_id')
                ->constrained('family_plans');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
