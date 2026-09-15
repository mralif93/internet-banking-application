<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::updateOrCreate(
            ['username' => 'daniel_alif'],
            [
                'name' => 'Ahmad Daniel Bin Alif',
                'email' => 'daniel.alif@bankflow.my',
                'nric' => '930412-14-5555',
                'phone_number' => '+60 12-345 6789',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'account_number' => '1640 1234 5678',
                'account_balance' => 24850.50,
                'account_type' => 'Savings Account-i',
                'bound_device_name' => 'iPhone 16 Pro (Hardware Enclave)',
                'bound_device_id' => 'DEV-APPL-9382104-SEC',
            ]
        );
    }
}
