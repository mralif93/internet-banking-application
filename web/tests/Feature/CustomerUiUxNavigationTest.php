<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;
use Database\Seeders\DatabaseSeeder;

class CustomerUiUxNavigationTest extends TestCase
{
    use RefreshDatabase;

    protected Customer $customer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
        $this->customer = Customer::where('username', 'daniel_alif')->first();
    }

    public function test_guest_is_redirected_from_all_protected_routes(): void
    {
        $routes = [
            '/customer/dashboard',
            '/customer/transfer',
            '/customer/jompay',
            '/customer/qr-pay',
            '/customer/statement',
            '/customer/history',
            '/customer/cards',
            '/customer/settings',
        ];

        foreach ($routes as $url) {
            $response = $this->get($url);
            $response->assertRedirect('/login');
        }
    }

    public function test_customer_dashboard_renders_with_essential_ui_elements(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->get('/customer/dashboard');
        $response->assertStatus(200);

        // Header & Telemetry
        $response->assertSee('Retail Banking Dashboard');
        $response->assertSee('Welcome, Ahmad Daniel Bin Alif');
        $response->assertSee('1640 1234 5678');
        $response->assertSee('Savings Account-i');

        // Quick Action Shortcuts & Services
        $response->assertSee('Quick Banking Services');
        $response->assertSee('DuitNow');
        $response->assertSee('JomPAY');
        $response->assertSee('e-Statement');
    }

    public function test_customer_transfer_page_renders_clean_form_and_payee_list(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->get('/customer/transfer');
        $response->assertStatus(200);

        // Branding and Form Fields
        $response->assertSee('DuitNow Instant Transfer');
        $response->assertSee('Amount (RM)');
        $response->assertSee('Hardware Enclave Protected');
        $response->assertSee('PayNet DuitNow 2.0');
    }

    public function test_customer_jompay_page_renders_biller_directory(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->get('/customer/jompay');
        $response->assertStatus(200);

        $response->assertSee('JomPAY');
        $response->assertSee('Biller Code');
        $response->assertSee('Tenaga Nasional Berhad');
    }

    public function test_customer_history_renders_transactions_and_badges(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->get('/customer/history');
        $response->assertStatus(200);

        $response->assertSee('Transaction History');
        $response->assertSee('PETRONAS Dagangan Berhad');
        $response->assertSee('Tenaga Nasional Berhad');
    }

    public function test_customer_statement_renders_breakdown(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->get('/customer/statement');
        $response->assertStatus(200);

        $response->assertSee('Official e-Statement');
        $response->assertSee('Ahmad Daniel Bin Alif');
        $response->assertSee('1640 1234 5678');
    }

    public function test_customer_cards_page_renders_card_details(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->get('/customer/cards');
        $response->assertStatus(200);

        $response->assertSee('Debit Mastercard-i');
        $response->assertSee('AHMAD DANIEL BIN ALIF');
        $response->assertSee('Manage Cards &amp; Limits', false);
    }

    public function test_customer_settings_page_renders_security_controls_and_kill_switch(): void
    {
        $response = $this->actingAs($this->customer, 'customer')->get('/customer/settings');
        $response->assertStatus(200);

        $response->assertSee('Account Settings &amp; Security', false);
        $response->assertSee('Profile &amp; Identity', false);
        $response->assertSee('Security &amp; Auth', false);
        $response->assertSee('Hardware Enclave Bound', false);
        $response->assertSee('Danger Zone');
    }
}
