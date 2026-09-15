<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Customer;
use App\Services\TransactionLimitService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TransactionLimitServiceUnitTest extends TestCase
{
    use RefreshDatabase;

    protected TransactionLimitService $limitService;
    protected Customer $customer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->limitService = new TransactionLimitService();

        $this->customer = Customer::create([
            'name' => 'Limit Test Customer',
            'username' => 'limit_test',
            'email' => 'limit@bankflow.my',
            'password' => Hash::make('secret123'),
            'status' => 'active',
        ]);
    }

    public function test_check_limit_allows_under_threshold(): void
    {
        $allowed = $this->limitService->checkLimit($this->customer, 'duitnow', 500.00);
        $this->assertTrue($allowed);
    }

    public function test_consume_limit_tracks_spent_amount(): void
    {
        $this->limitService->consumeLimit($this->customer, 'duitnow', 1500.00);

        $limit = $this->limitService->getOrCreateLimit($this->customer, 'duitnow');
        $this->assertEquals(1500.00, $limit->spent_today);

        // Cannot spend more than daily limit (default 10,000)
        $allowed = $this->limitService->checkLimit($this->customer, 'duitnow', 9000.00);
        $this->assertFalse($allowed);

        // Can still spend 8,500
        $allowed = $this->limitService->checkLimit($this->customer, 'duitnow', 8500.00);
        $this->assertTrue($allowed);
    }
}
