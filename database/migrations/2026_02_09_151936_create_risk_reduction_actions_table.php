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
        Schema::create('risk_reduction_actions', function (Blueprint $table) {
            $table->id();

            // Action to be carried out
            $table->string('action', 255);

            // FK - Family member at risk
            $table->foreignId('member_id')->constrained('members');

            // FK - Related risk factor
            $table->foreignId('risk_factor_id')->constrained('risk_factors'); // change if your table name differs

            // Date when the action ends
            $table->date('end_date');

            // Created_at & Updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_reduction_actions');
    }
};
