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
        Schema::create('risk_factors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('threat_type_id')->constrained('threat_types');
            $table->string('description', 255);
            $table->string('ubication', 255);
            $table->unsignedInteger('distance');
            $table->foreignId('family_plan_id')->constrained('family_plans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_factors');
    }
};
