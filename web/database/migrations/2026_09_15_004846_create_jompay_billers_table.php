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
        Schema::create('jompay_billers', function (Blueprint $table) {
            $table->id();
            $table->string('biller_code', 20)->unique();
            $table->string('biller_name', 150);
            $table->string('category', 100)->default('Utilities');
            $table->string('ref_1_label', 50)->default('Account No');
            $table->string('ref_2_label', 50)->nullable();
            $table->boolean('is_ref_2_required')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jompay_billers');
    }
};
