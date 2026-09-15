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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_code', 20)->unique(); // MBB, CIMB, PBB, etc.
            $table->string('bank_name', 150); // Malayan Banking Berhad
            $table->string('short_name', 50); // Maybank
            $table->string('swift_code', 20)->nullable(); // MBBEMYKL
            $table->boolean('is_duitnow_active')->default(true);
            $table->boolean('is_ibg_active')->default(true);
            $table->boolean('is_active')->default(true);
            $table->string('maintenance_notice')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
