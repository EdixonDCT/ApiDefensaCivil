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
        Schema::create('vulnerable_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vulnerable_question_id')->constrained();
            $table->foreignId('family_plan_id')->constrained();
            $table->boolean('answer')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vulnerable_tests');
    }
};
