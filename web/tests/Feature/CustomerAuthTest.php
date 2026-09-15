<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CustomerAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_view_login_page(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Retail Internet Banking');
    }

    public function test_customer_cannot_access_dashboard_without_authentication(): void
    {
        $response = $this->get('/customer/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_customer_can_authenticate_using_customers_table(): void
    {
        $customer = Customer::create([
            'name' => 'Ahmad Daniel Bin Alif',
            'username' => 'daniel_alif',
            'email' => 'daniel.alif@bankflow.my',
            'nric' => '930412-14-5555',
            'phone_number' => '+60 12-345 6789',
            'password' => Hash::make('password123'),
            'status' => 'active',
            'account_number' => '1640 1234 5678',
            'account_balance' => 24850.50,
            'account_type' => 'Savings Account-i',
            'bound_device_name' => 'iPhone 16 Pro (Hardware Enclave)',
        ]);

        $response = $this->post('/login', [
            'username' => 'daniel_alif',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/customer/dashboard');
        $this->assertAuthenticatedAs($customer, 'customer');

        $dashboardResponse = $this->actingAs($customer, 'customer')->get('/customer/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Ahmad Daniel Bin Alif');
        $dashboardResponse->assertSee('1640 1234 5678');
        $dashboardResponse->assertSee('24,850.50');
    }

    public function test_customer_cannot_authenticate_with_invalid_password(): void
    {
        Customer::create([
            'name' => 'Ahmad Daniel Bin Alif',
            'username' => 'daniel_alif',
            'email' => 'daniel.alif@bankflow.my',
            'password' => Hash::make('password123'),
            'status' => 'active',
        ]);

        $response = $this->from('/login')->post('/login', [
            'username' => 'daniel_alif',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('username');
        $this->assertGuest('customer');
    }

    public function test_customer_can_logout(): void
    {
        $customer = Customer::create([
            'name' => 'Ahmad Daniel Bin Alif',
            'username' => 'daniel_alif',
            'email' => 'daniel.alif@bankflow.my',
            'password' => Hash::make('password123'),
            'status' => 'active',
        ]);

        $response = $this->actingAs($customer, 'customer')->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest('customer');
    }
}
