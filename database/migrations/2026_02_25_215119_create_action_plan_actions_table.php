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
        Schema::create('action_plan_actions', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('action_type_id')->constrained('action_types');

            $table->string('description', 255);

            $table->foreignId('member_id')->constrained('members');

            $table->foreignId('action_plan_id')->constrained('action_plans');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('action_plan_actions');
    }
};
