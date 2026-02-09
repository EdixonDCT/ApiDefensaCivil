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
        Schema::create('threat_types', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name', 255); // varchar(255) NOT NULL
            $table->boolean('is_active')->default(true); // boolean status
            $table->timestamps(); // created_at & updated_at
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threat_types');
    }
};
