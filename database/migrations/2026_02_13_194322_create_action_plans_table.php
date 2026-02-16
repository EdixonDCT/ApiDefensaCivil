<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('action_plans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('integrante_id');
            
            $table->unsignedBigInteger('vulnerability_factor_id');

            $table->timestamps();

            $table->foreign('integrante_id')->references('id')->on('members');

            $table->foreign('vulnerability_factor_id')->references('id')->on('vulnerability_factors');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('action_plans');
    }
};
