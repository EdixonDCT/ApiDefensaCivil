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
        Schema::create('family_plans', function (Blueprint $table) {
            $table->id();
            $table->string('last_names',255);  
            $table->foreignId('zone_id')->constrained();
            $table->string('address',255);
            $table->string('landline_phone',10);
            $table->text('georeference');
            $table->foreignId('city_id')->constrained();
            $table->foreignId('housing_quality_id')->constrained();
            $table->foreignId('sector_id')->constrained();
            $table->string('sector_name',50);
            $table->foreignId('status_plan_id')->constrained();
            $table->foreignId('sectionals_id')->constrained();
            $table->boolean('authorization')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_plans');
    }
};
