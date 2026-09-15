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
        Schema::create('system_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('category', 50)->index(); // cooling_off, payment_rails, limit_caps, maintenance
            $table->string('param_key', 100)->unique();
            $table->text('param_value')->nullable();
            $table->string('value_type', 20)->default('string'); // string, integer, decimal, boolean, json
            $table->string('display_name', 150);
            $table->text('description')->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_parameters');
    }
};
