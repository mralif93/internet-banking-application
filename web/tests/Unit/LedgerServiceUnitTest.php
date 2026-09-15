<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\Account;
use App\Services\LedgerService;
use App\Services\TransactionLimitService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;

class LedgerServiceUnitTest extends TestCase
{
    use RefreshDatabase;

    protected LedgerService $ledgerService;
    protected Customer $customer;
    protected Account $account;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ledgerService = new LedgerService();

        $this->customer = Customer::create([
            'name' => 'Alif Test Customer',
            'username' => 'alif_test',
            'email' => 'alif@bankflow.my',
            'password' => Hash::make('secret123'),
            'status' => 'active',
            'account_number' => '1640 9999 1111',
            'account_balance' => 5000.00,
        ]);

        $this->account = Account::create([
            'customer_id' => $this->customer->id,
            'account_number' => '1640 9999 1111',
            'account_type' => 'savings',
            'currency' => 'MYR',
            'balance' => 5000.00,
            'available_balance' => 5000.00,
            'status' => 'active',
        ]);
    }

    public function test_generate_reference_format(): void
    {
        $ref = LedgerService::generateReference('RPP');
        $this->assertStringStartsWith('RPP-', $ref);
        $this->assertMatchesRegularExpression('/^RPP-\d{8}-[A-F0-9]{8}$/', $ref);
    }

    public function test_debit_decreases_balance_correctly(): void
    {
        $txn = $this->ledgerService->debit($this->account, 250.00, 'duitnow_transfer', [
            'recipient_name' => 'Testing Payee',
        ]);

        $this->account->refresh();
        $this->assertEquals(4750.00, $this->account->balance);
        $this->assertEquals(4750.00, $this->account->available_balance);
        $this->assertEquals(4750.00, $txn->balance_after);
        $this->assertEquals('debit', $txn->direction);
        $this->assertEquals(250.00, $txn->amount);
    }

    public function test_debit_throws_exception_on_zero_or_negative_amount(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Debit amount must be greater than zero.');
        $this->ledgerService->debit($this->account, 0.00, 'duitnow_transfer');
    }

    public function test_debit_throws_exception_on_insufficient_balance(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Insufficient account balance');
        $this->ledgerService->debit($this->account, 99999.00, 'duitnow_transfer');
    }

    public function test_debit_throws_exception_on_inactive_or_frozen_account(): void
    {
        $this->account->status = 'frozen';
        $this->account->save();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Account is not active');
        $this->ledgerService->debit($this->account, 100.00, 'duitnow_transfer');
    }

    public function test_credit_increases_balance_correctly(): void
    {
        $txn = $this->ledgerService->credit($this->account, 1200.00, 'deposit', [
            'sender_name' => 'Monthly Bonus',
        ]);

        $this->account->refresh();
        $this->assertEquals(6200.00, $this->account->balance);
        $this->assertEquals(6200.00, $this->account->available_balance);
        $this->assertEquals(6200.00, $txn->balance_after);
        $this->assertEquals('credit', $txn->direction);
        $this->assertEquals(1200.00, $txn->amount);
    }
}
