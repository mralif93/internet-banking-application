<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;
use App\Models\Account;
use App\Models\JompayBiller;
use App\Models\Transaction;
use Database\Seeders\DatabaseSeeder;

class CoreBankingFunctionalityTest extends TestCase
{
    use RefreshDatabase;

    protected Customer $customer;
    protected Customer $customer2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->customer = Customer::where('username', 'daniel_alif')->first();
        $this->customer2 = Customer::where('username', 'sarah_zulkifli')->first();
    }

    public function test_customer_can_view_dashboard_with_live_account(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->get('/customer/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Ahmad Daniel Bin Alif');
        $response->assertSee('1640 1234 5678');
    }

    public function test_duitnow_transfer_deducts_balance_and_creates_transaction(): void
    {
        $initialBalance = $this->customer->accounts()->first()->balance;

        $response = $this->actingAs($this->customer, 'customer')->postJson('/customer/transfer', [
            'amount' => 150.00,
            'recipient_name' => 'Mohd Haziq',
            'recipient_bank' => 'Maybank Berhad',
            'recipient_account' => '1140 5512 3341',
            'payment_reference' => 'Groceries share',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $account = $this->customer->accounts()->first()->fresh();
        $this->assertEquals($initialBalance - 150.00, $account->balance);

        $this->assertDatabaseHas('transactions', [
            'account_id' => $account->id,
            'transaction_type' => 'duitnow_transfer',
            'amount' => 150.00,
            'recipient_name' => 'Mohd Haziq',
            'status' => 'completed',
        ]);
    }

    public function test_internal_transfer_credits_recipient_account(): void
    {
        $senderAccount = $this->customer->accounts()->first();
        $recipientAccount = $this->customer2->accounts()->first();

        $senderBalanceBefore = $senderAccount->balance;
        $recipientBalanceBefore = $recipientAccount->balance;

        $response = $this->actingAs($this->customer, 'customer')->postJson('/customer/transfer', [
            'amount' => 200.00,
            'recipient_name' => 'Sarah Binti Zulkifli',
            'recipient_bank' => 'BankFlow MY',
            'recipient_account' => $recipientAccount->account_number,
            'payment_reference' => 'Gift',
            'is_trusted_payee' => true,
        ]);

        $response->assertStatus(200);

        $this->assertEquals($senderBalanceBefore - 200.00, $senderAccount->fresh()->balance);
        $this->assertEquals($recipientBalanceBefore + 200.00, $recipientAccount->fresh()->balance);
    }

    public function test_transfer_fails_when_insufficient_funds(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->postJson('/customer/transfer', [
            'amount' => 999999.00,
            'recipient_name' => 'Anyone',
            'recipient_bank' => 'Maybank Berhad',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['success', 'message']);
    }

    public function test_jompay_bill_payment_works(): void
    {
        $initialBalance = $this->customer->accounts()->first()->balance;

        $response = $this->actingAs($this->customer, 'customer')->postJson('/customer/jompay', [
            'biller_code' => '5454',
            'ref_1' => '220199248810',
            'amount' => 120.50,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'biller_code' => '5454',
        ]);

        $account = $this->customer->accounts()->first()->fresh();
        $this->assertEquals($initialBalance - 120.50, $account->balance);

        $this->assertDatabaseHas('transactions', [
            'account_id' => $account->id,
            'transaction_type' => 'jompay',
            'biller_code' => '5454',
            'ref_1' => '220199248810',
        ]);
    }

    public function test_emergency_kill_switch_freezes_account(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->postJson('/customer/settings/kill-switch', [
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->customer->refresh();
        $this->assertEquals('suspended', $this->customer->status);
        $this->assertEquals('frozen', $this->customer->accounts()->first()->status);
        $this->assertEquals('frozen', $this->customer->cards()->first()->status);

        $this->assertDatabaseHas('audit_logs', [
            'customer_id' => $this->customer->id,
            'event' => 'EMERGENCY_KILL_SWITCH_ACTIVATED',
        ]);
    }

    public function test_customer_can_export_statement_csv(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->get('/customer/statement/export?format=csv&year=2026&month=9');
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');
    }

    public function test_customer_can_view_certified_statement_print_page(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->get('/customer/statement/export?format=pdf&year=2026&month=9');
        $response->assertStatus(200);
        $response->assertSee('BANKFLOW MALAYSIA BERHAD');
        $response->assertSee('CERTIFIED OFFICIAL e-STATEMENT');
        $response->assertSee('Ahmad Daniel Bin Alif');
    }

    public function test_customer_can_create_and_manage_beneficiaries(): void
    {
        // 1. Create Beneficiary
        $createResponse = $this->actingAs($this->customer, 'customer')->postJson('/customer/beneficiaries', [
            'nickname' => 'Syakir Asyraf',
            'bank_name' => 'CIMB Bank Berhad',
            'account_number' => '7012938192',
            'is_favorite' => true,
        ]);
        $createResponse->assertStatus(201);
        $createResponse->assertJson(['success' => true]);
        $payeeId = $createResponse->json('data.id');

        $this->assertDatabaseHas('beneficiaries', [
            'customer_id' => $this->customer->id,
            'nickname' => 'Syakir Asyraf',
            'is_favorite' => 1,
        ]);

        // 2. Toggle Favorite
        $favResponse = $this->actingAs($this->customer, 'customer')->postJson("/customer/beneficiaries/{$payeeId}/favorite");
        $favResponse->assertStatus(200);
        $favResponse->assertJson(['is_favorite' => false]);

        // 3. Delete Beneficiary
        $delResponse = $this->actingAs($this->customer, 'customer')->deleteJson("/customer/beneficiaries/{$payeeId}");
        $delResponse->assertStatus(200);
        $delResponse->assertJson(['success' => true]);

        $this->assertDatabaseMissing('beneficiaries', [
            'id' => $payeeId,
        ]);
    }
}
