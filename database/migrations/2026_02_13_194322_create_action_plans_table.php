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

            $table->unsignedBigInteger('member_id');
            
            $table->unsignedBigInteger('risk_factor_id');

            $table->foreign('member_id')->references('id')->on('members');

            $table->foreign('risk_factor_id')->references('id')->on('risk_factors');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('action_plans');
    }
};
