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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');
            $table->string('card_number_masked', 25);
            $table->string('card_holder_name', 100);
            $table->string('card_type', 30)->default('debit_visa');
            $table->string('expiry_month', 2)->default('12');
            $table->string('expiry_year', 2)->default('29');
            $table->string('status', 20)->default('active'); // active, frozen, cancelled
            $table->boolean('is_overseas_enabled')->default(false);
            $table->boolean('is_online_enabled')->default(true);
            $table->boolean('is_contactless_enabled')->default(true);
            $table->decimal('daily_purchase_limit', 10, 2)->default(5000.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
