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
        Schema::create('available_resources', function (Blueprint $table) {
            $table->id(); 

            $table->unsignedBigInteger('resource_id'); 
            $table->string('location', 255);
            $table->unsignedInteger('distance');
            $table->string('phone', 10);
            $table->string('description', 255);
            $table->unsignedBigInteger('family_plan_id'); 
            $table->timestamps();
            $table->foreign('resource_id')->references('id')->on('resources'); 
            $table->foreign('family_plan_id')->references('id')->on('family_plans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_resources');
    }
};
