<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;
use App\Models\SystemParameter;
use App\Models\JompayBiller;
use App\Services\SystemParameterService;
use Database\Seeders\DatabaseSeeder;

class AdminPortalAndParametersTest extends TestCase
{
    use RefreshDatabase;

    protected \App\Models\User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->admin = \App\Models\User::where('email', 'admin@bankflow.my')->first();
        $this->actingAs($this->admin, 'web');
    }

    public function test_unauthenticated_user_cannot_access_admin_portal(): void
    {
        \Illuminate\Support\Facades\Auth::guard('web')->logout();

        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        \Illuminate\Support\Facades\Auth::guard('web')->logout();

        $response = $this->post('/admin/login', [
            'login' => 'farhan_azman',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($this->admin, 'web');

        $this->assertDatabaseHas('audit_logs', [
            'event' => 'ADMIN_LOGIN_SUCCESS',
        ]);
    }

    public function test_admin_can_logout(): void
    {
        $response = $this->post('/admin/logout');
        $response->assertRedirect('/admin/login');
        $this->assertGuest('web');

        $this->assertDatabaseHas('audit_logs', [
            'event' => 'ADMIN_LOGOUT',
        ]);
    }

    public function test_admin_dashboard_renders_successfully(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Real-Time AML / Anti-Fraud Radar');
        $response->assertSee('Universal Freeze Switch');
    }

    public function test_admin_parameters_page_renders_with_categories(): void
    {
        $response = $this->get('/admin/parameters');
        $response->assertStatus(200);
        $response->assertSee('System Parameter & Operational Controls');
        $response->assertSee('BNM Cooling-Off & Safety Parameters');
        $response->assertSee('Payment Rail Circuit Breakers');
        $response->assertSee('Registered JomPAY Biller Directory');
    }

    public function test_admin_can_update_system_parameters(): void
    {
        $response = $this->postJson('/admin/parameters', [
            'parameters' => [
                'cooling_off_period_hours' => 24,
                'cooling_off_threshold_amount' => '2500.00',
                'maintenance_mode_active' => '1',
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $service = app(SystemParameterService::class);
        $this->assertEquals(24, $service->getCoolingOffHours());
        $this->assertEquals(2500.00, $service->getCoolingOffThreshold());
        $this->assertTrue($service->isMaintenanceMode());

        $this->assertDatabaseHas('audit_logs', [
            'event' => 'SYSTEM_PARAMETER_MODIFIED',
        ]);
    }

    public function test_admin_can_register_and_toggle_jompay_billers(): void
    {
        // 1. Register new biller
        $createResponse = $this->postJson('/admin/parameters/biller', [
            'biller_code' => '9999',
            'biller_name' => 'Majlis Bandaraya Petaling Jaya (MBPJ)',
            'category' => 'Assessment & Municipal',
            'ref_1_label' => 'Tax Assessment Number',
        ]);

        $createResponse->assertStatus(201);
        $createResponse->assertJson(['success' => true]);
        $billerId = $createResponse->json('data.id');

        $this->assertDatabaseHas('jompay_billers', [
            'biller_code' => '9999',
            'is_active' => 1,
        ]);

        // 2. Toggle active state
        $toggleResponse = $this->postJson("/admin/parameters/biller/{$billerId}/toggle");
        $toggleResponse->assertStatus(200);
        $toggleResponse->assertJson(['is_active' => false]);

        $this->assertDatabaseHas('jompay_billers', [
            'id' => $billerId,
            'is_active' => 0,
        ]);
    }

    public function test_admin_can_freeze_and_reactivate_customer_account(): void
    {
        $customer = Customer::where('username', 'daniel_alif')->first();

        // Freeze customer
        $freezeResponse = $this->postJson("/admin/customers/{$customer->id}/toggle-status", [
            'reason' => 'Suspicious cross-border activity under review',
        ]);

        $freezeResponse->assertStatus(200);
        $freezeResponse->assertJson(['status' => 'suspended']);

        $customer->refresh();
        $this->assertEquals('suspended', $customer->status);
        $this->assertEquals('frozen', $customer->accounts()->first()->status);

        $this->assertDatabaseHas('audit_logs', [
            'customer_id' => $customer->id,
            'event' => 'ADMIN_CUSTOMER_SUSPENDED',
        ]);

        // Reactivate customer
        $reactivateResponse = $this->postJson("/admin/customers/{$customer->id}/toggle-status");
        $reactivateResponse->assertStatus(200);
        $reactivateResponse->assertJson(['status' => 'active']);

        $customer->refresh();
        $this->assertEquals('active', $customer->status);
        $this->assertEquals('active', $customer->accounts()->first()->status);
    }

    public function test_admin_audit_logs_page_renders_with_records(): void
    {
        $response = $this->get('/admin/audit-logs');
        $response->assertStatus(200);
        $response->assertSee('WORM Compliance Audit Trail');
    }

    public function test_admin_can_register_and_toggle_bank_institutions(): void
    {
        // 1. Register a new bank
        $response = $this->postJson('/admin/parameters/bank', [
            'bank_code' => 'TEST_BANK',
            'bank_name' => 'Bank of Digital Innovation Malaysia Berhad',
            'short_name' => 'BDIM',
            'swift_code' => 'BDIMMYKL',
        ]);

        $response->assertStatus(201);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('banks', [
            'bank_code' => 'TEST_BANK',
            'short_name' => 'BDIM',
            'is_active' => true,
        ]);

        $bank = \App\Models\Bank::where('bank_code', 'TEST_BANK')->first();
        $this->assertNotNull($bank);

        // 2. Toggle Bank State (take offline)
        $toggleOffResponse = $this->postJson("/admin/parameters/bank/{$bank->id}/toggle");
        $toggleOffResponse->assertStatus(200);
        $toggleOffResponse->assertJson(['is_active' => false]);

        $bank->refresh();
        $this->assertFalse($bank->is_active);

        // 3. Toggle Bank State back online
        $toggleOnResponse = $this->postJson("/admin/parameters/bank/{$bank->id}/toggle");
        $toggleOnResponse->assertStatus(200);
        $toggleOnResponse->assertJson(['is_active' => true]);

        $bank->refresh();
        $this->assertTrue($bank->is_active);
    }
}

