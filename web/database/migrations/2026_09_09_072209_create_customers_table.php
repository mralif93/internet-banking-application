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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('nric')->unique()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('password');
            $table->string('status')->default('active'); // active, suspended, locked
            $table->string('account_number')->nullable();
            $table->decimal('account_balance', 15, 2)->default(24850.50);
            $table->string('account_type')->default('Savings Account-i');
            $table->string('bound_device_name')->nullable()->default('iPhone 16 Pro (Hardware Enclave)');
            $table->string('bound_device_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
