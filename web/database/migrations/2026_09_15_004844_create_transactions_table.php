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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number', 40)->unique();
            $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');
            $table->string('transaction_type', 30); // duitnow_transfer, jompay, qr_pay, fpx, deposit, withdrawal
            $table->enum('direction', ['debit', 'credit']);
            $table->decimal('amount', 15, 2);
            $table->decimal('fee', 8, 2)->default(0.00);
            $table->string('recipient_name', 150)->nullable();
            $table->string('recipient_bank', 100)->nullable();
            $table->string('recipient_account', 50)->nullable();
            $table->string('payment_reference', 100)->nullable();
            $table->string('recipient_reference', 100)->nullable();
            $table->string('biller_code', 20)->nullable();
            $table->string('biller_name', 150)->nullable();
            $table->string('ref_1', 50)->nullable();
            $table->string('ref_2', 50)->nullable();
            $table->string('status', 20)->default('completed'); // completed, pending, cooling_off, failed, rejected, reversed
            $table->timestamp('cooling_off_until')->nullable();
            $table->decimal('balance_after', 15, 2)->default(0.00);
            $table->text('description')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
