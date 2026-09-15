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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('nickname', 100);
            $table->string('account_number', 50)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('duitnow_id_type', 30)->nullable(); // nric, mobile, passport, army_police, business_reg
            $table->string('duitnow_id_value', 100)->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->timestamp('last_transferred_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
