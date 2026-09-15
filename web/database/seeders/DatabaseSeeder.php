<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Beneficiary;
use App\Models\JompayBiller;
use App\Models\TransactionLimit;
use App\Models\Card;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Customer
        $customer = Customer::updateOrCreate(
            ['username' => 'daniel_alif'],
            [
                'name' => 'Ahmad Daniel Bin Alif',
                'email' => 'daniel.alif@bankflow.my',
                'nric' => '930412-14-5589',
                'phone_number' => '+60 12-345 6789',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'account_number' => '1640 1234 5678',
                'account_balance' => 24850.50,
                'account_type' => 'Savings Account-i',
                'bound_device_name' => 'iPhone 16 Pro (Hardware Enclave)',
                'bound_device_id' => 'DEV-APPL-99214',
            ]
        );

        // Also create a second customer for internal transfers
        $customer2 = Customer::updateOrCreate(
            ['username' => 'sarah_zulkifli'],
            [
                'name' => 'Sarah Binti Zulkifli',
                'email' => 'sarah.z@bankflow.my',
                'nric' => '950821-10-6622',
                'phone_number' => '+60 19-876 5432',
                'password' => Hash::make('password123'),
                'status' => 'active',
                'account_number' => '1640 8888 9999',
                'account_balance' => 12400.00,
                'account_type' => 'Savings Account-i',
                'bound_device_name' => 'Samsung Galaxy S24 Ultra',
                'bound_device_id' => 'DEV-SAMS-11029',
            ]
        );

        // 2. Primary Accounts
        $account1 = Account::updateOrCreate(
            ['account_number' => '1640 1234 5678'],
            [
                'customer_id' => $customer->id,
                'account_type' => 'savings',
                'account_name' => 'Savings Account-i',
                'currency' => 'MYR',
                'balance' => 24850.50,
                'available_balance' => 24850.50,
                'status' => 'active',
            ]
        );

        $account2 = Account::updateOrCreate(
            ['account_number' => '1640 8888 9999'],
            [
                'customer_id' => $customer2->id,
                'account_type' => 'savings',
                'account_name' => 'Savings Account-i',
                'currency' => 'MYR',
                'balance' => 12400.00,
                'available_balance' => 12400.00,
                'status' => 'active',
            ]
        );

        // 3. JomPAY Billers
        $billers = [
            [
                'biller_code' => '5454',
                'biller_name' => 'Tenaga Nasional Berhad (TNB)',
                'category' => 'Utilities (Electricity)',
                'ref_1_label' => 'Electricity Account No',
                'ref_2_label' => null,
                'is_ref_2_required' => false,
            ],
            [
                'biller_code' => '8888',
                'biller_name' => 'Pengurusan Air Selangor Sdn Bhd',
                'category' => 'Utilities (Water)',
                'ref_1_label' => 'Water Account No',
                'ref_2_label' => null,
                'is_ref_2_required' => false,
            ],
            [
                'biller_code' => '2222',
                'biller_name' => 'TM Unifi Home Broadband',
                'category' => 'Telecommunications & Internet',
                'ref_1_label' => 'Unifi Account No',
                'ref_2_label' => 'Contact Mobile Number',
                'is_ref_2_required' => false,
            ],
            [
                'biller_code' => '1122',
                'biller_name' => 'Astro Malaysia Holdings',
                'category' => 'Entertainment & Media',
                'ref_1_label' => 'Astro Account No',
                'ref_2_label' => null,
                'is_ref_2_required' => false,
            ],
            [
                'biller_code' => '6012',
                'biller_name' => 'Maxis Postpaid & Fibre',
                'category' => 'Telecommunications & Internet',
                'ref_1_label' => 'Maxis Account No',
                'ref_2_label' => 'Mobile No',
                'is_ref_2_required' => true,
            ],
        ];

        foreach ($billers as $b) {
            JompayBiller::updateOrCreate(['biller_code' => $b['biller_code']], $b);
        }

        // 4. Beneficiaries
        $beneficiaries = [
            [
                'customer_id' => $customer->id,
                'nickname' => 'Sarah Zulkifli (Sister)',
                'account_number' => '1640 8888 9999',
                'bank_name' => 'BankFlow MY',
                'duitnow_id_type' => 'mobile',
                'duitnow_id_value' => '+60 19-876 5432',
                'is_favorite' => true,
                'last_transferred_at' => Carbon::now()->subDays(1),
            ],
            [
                'customer_id' => $customer->id,
                'nickname' => 'Mohd Haziq (Housemate)',
                'account_number' => '1140 5512 3341',
                'bank_name' => 'Maybank Berhad',
                'duitnow_id_type' => 'nric',
                'duitnow_id_value' => '940510-10-5511',
                'is_favorite' => true,
                'last_transferred_at' => Carbon::now()->subDays(4),
            ],
            [
                'customer_id' => $customer->id,
                'nickname' => 'Lim Wei Seng',
                'account_number' => '8001 2299 4410',
                'bank_name' => 'CIMB Bank Berhad',
                'duitnow_id_type' => 'mobile',
                'duitnow_id_value' => '+60 16-222 3399',
                'is_favorite' => false,
                'last_transferred_at' => Carbon::now()->subDays(2),
            ],
        ];

        foreach ($beneficiaries as $ben) {
            Beneficiary::updateOrCreate(
                ['customer_id' => $ben['customer_id'], 'nickname' => $ben['nickname']],
                $ben
            );
        }

        // 5. Transaction Limits
        $limits = [
            ['limit_type' => 'duitnow', 'daily_limit' => 10000.00, 'spent_today' => 1285.00],
            ['limit_type' => 'jompay', 'daily_limit' => 5000.00, 'spent_today' => 178.40],
            ['limit_type' => 'qr_pay', 'daily_limit' => 2000.00, 'spent_today' => 85.00],
            ['limit_type' => 'fpx', 'daily_limit' => 10000.00, 'spent_today' => 0.00],
            ['limit_type' => 'atm_withdrawal', 'daily_limit' => 5000.00, 'spent_today' => 0.00],
        ];

        foreach ($limits as $lim) {
            TransactionLimit::updateOrCreate(
                ['customer_id' => $customer->id, 'limit_type' => $lim['limit_type']],
                array_merge($lim, [
                    'customer_id' => $customer->id,
                    'last_reset_date' => Carbon::today(),
                ])
            );
        }

        // 6. Debit Card
        Card::updateOrCreate(
            ['customer_id' => $customer->id, 'card_number_masked' => '4532 •••• •••• 8821'],
            [
                'customer_id' => $customer->id,
                'account_id' => $account1->id,
                'card_holder_name' => 'AHMAD DANIEL',
                'card_type' => 'debit_visa',
                'expiry_month' => '09',
                'expiry_year' => '29',
                'status' => 'active',
                'is_overseas_enabled' => false,
                'is_online_enabled' => true,
                'is_contactless_enabled' => true,
                'daily_purchase_limit' => 5000.00,
            ]
        );

        // 7. Seed Sample Transaction History
        $txns = [
            [
                'reference_number' => 'RPP-20260915-082104',
                'account_id' => $account1->id,
                'transaction_type' => 'qr_pay',
                'direction' => 'debit',
                'amount' => 85.00,
                'fee' => 0.00,
                'recipient_name' => 'PETRONAS Dagangan Berhad',
                'payment_reference' => 'Fuel & Retail Payment',
                'recipient_reference' => 'PETRONAS-KLCC-01',
                'status' => 'completed',
                'balance_after' => 24850.50,
                'description' => 'DuitNow QR - PETRONAS Dagangan Berhad',
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'reference_number' => 'DN-MY-9921048821',
                'account_id' => $account1->id,
                'transaction_type' => 'duitnow_transfer',
                'direction' => 'credit',
                'amount' => 450.00,
                'fee' => 0.00,
                'recipient_name' => 'Sarah Binti Zulkifli',
                'recipient_bank' => 'BankFlow MY',
                'recipient_account' => '1640 8888 9999',
                'payment_reference' => 'Weekend trip dinner share',
                'recipient_reference' => 'Trip share',
                'status' => 'completed',
                'balance_after' => 24935.50,
                'description' => 'Transfer from Sarah Binti Zulkifli',
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'reference_number' => 'COOL-HOLD-992184',
                'account_id' => $account1->id,
                'transaction_type' => 'duitnow_transfer',
                'direction' => 'debit',
                'amount' => 1200.00,
                'fee' => 0.00,
                'recipient_name' => 'Lim Wei Seng',
                'recipient_bank' => 'CIMB Bank Berhad',
                'recipient_account' => '8001 2299 4410',
                'payment_reference' => 'Design Project Milestone 1',
                'recipient_reference' => 'Freelance Milestone',
                'status' => 'cooling_off',
                'cooling_off_until' => Carbon::now()->addHours(7),
                'balance_after' => 24485.50,
                'description' => 'DuitNow Instant - Lim Wei Seng (12-hr Cooling-off Hold)',
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'reference_number' => 'JOM-5454-99210',
                'account_id' => $account1->id,
                'transaction_type' => 'jompay',
                'direction' => 'debit',
                'amount' => 178.40,
                'fee' => 0.00,
                'recipient_name' => 'Tenaga Nasional Berhad (TNB)',
                'biller_code' => '5454',
                'biller_name' => 'Tenaga Nasional Berhad',
                'ref_1' => '220199248810',
                'payment_reference' => 'Electricity Sept 2026',
                'status' => 'completed',
                'balance_after' => 25685.50,
                'description' => 'JomPAY Utility Payment - TNB',
                'created_at' => Carbon::yesterday()->setHour(14)->setMinute(15),
            ],
            [
                'reference_number' => 'SAL-20260901-0012',
                'account_id' => $account1->id,
                'transaction_type' => 'deposit',
                'direction' => 'credit',
                'amount' => 8500.00,
                'fee' => 0.00,
                'recipient_name' => 'PAYROLL TECH CORP SDN BHD',
                'payment_reference' => 'Monthly Salary Sept 2026',
                'status' => 'completed',
                'balance_after' => 25863.90,
                'description' => 'Salary Credit - PAYROLL TECH CORP',
                'created_at' => Carbon::now()->startOfMonth(),
            ],
        ];

        foreach ($txns as $t) {
            Transaction::updateOrCreate(
                ['reference_number' => $t['reference_number']],
                $t
            );
        }

        // 7. System Parameters for Admin Control
        $parameters = [
            // Cooling-off & Security
            [
                'category' => 'cooling_off',
                'param_key' => 'cooling_off_period_hours',
                'param_value' => '12',
                'value_type' => 'integer',
                'display_name' => 'BNM Cooling-Off Duration (Hours)',
                'description' => 'Mandatory delay before newly bound devices or limit upgrades take effect (BNM RMiT standard: 12 hours).',
                'updated_by' => 'System Initializer',
            ],
            [
                'category' => 'cooling_off',
                'param_key' => 'cooling_off_threshold_amount',
                'param_value' => '1000.00',
                'value_type' => 'decimal',
                'display_name' => 'High-Value Hold Threshold (MYR)',
                'description' => 'Transfer amounts to first-time payees exceeding this value require cooling-off or biometric step-up.',
                'updated_by' => 'System Initializer',
            ],
            [
                'category' => 'cooling_off',
                'param_key' => 'enforce_biometric_step_up',
                'param_value' => '1',
                'value_type' => 'boolean',
                'display_name' => 'Enforce Mobile Secure Enclave / Soft Token 2FA',
                'description' => 'Strictly enforce hardware biometric enclave authorization for transactions >= RM 500.',
                'updated_by' => 'System Initializer',
            ],
            // Payment Rails Status
            [
                'category' => 'payment_rails',
                'param_key' => 'duitnow_rail_active',
                'param_value' => '1',
                'value_type' => 'boolean',
                'display_name' => 'PayNet DuitNow Instant Rail',
                'description' => 'Master switch for ISO 20022 DuitNow interbank real-time retail payments clearing.',
                'updated_by' => 'System Initializer',
            ],
            [
                'category' => 'payment_rails',
                'param_key' => 'duitnow_qr_rail_active',
                'param_value' => '1',
                'value_type' => 'boolean',
                'display_name' => 'PayNet DuitNow QR Interoperable Rail',
                'description' => 'Enables national interoperable merchant QR scanning and dynamic peer QR generation.',
                'updated_by' => 'System Initializer',
            ],
            [
                'category' => 'payment_rails',
                'param_key' => 'jompay_rail_active',
                'param_value' => '1',
                'value_type' => 'boolean',
                'display_name' => 'JomPAY National Bill Payment Gateway',
                'description' => 'Biller settlement network for utility, telco, municipal, and educational billers.',
                'updated_by' => 'System Initializer',
            ],
            // Limit Caps
            [
                'category' => 'limit_caps',
                'param_key' => 'max_system_transfer_limit',
                'param_value' => '50000.00',
                'value_type' => 'decimal',
                'display_name' => 'Universal Maximum Daily Transfer Ceiling (MYR)',
                'description' => 'Absolute maximum daily transfer limit allowed across retail consumer tier accounts.',
                'updated_by' => 'System Initializer',
            ],
            [
                'category' => 'limit_caps',
                'param_key' => 'max_qr_single_transaction_limit',
                'param_value' => '3000.00',
                'value_type' => 'decimal',
                'display_name' => 'DuitNow QR Single Transaction Cap (MYR)',
                'description' => 'Maximum allowed per individual merchant QR transaction.',
                'updated_by' => 'System Initializer',
            ],
            // Maintenance Mode
            [
                'category' => 'maintenance',
                'param_key' => 'maintenance_mode_active',
                'param_value' => '0',
                'value_type' => 'boolean',
                'display_name' => 'Global Retail Platform Maintenance Mode',
                'description' => 'When active, customer portal displays scheduled maintenance banner with emergency contacts.',
                'updated_by' => 'System Initializer',
            ],
            [
                'category' => 'maintenance',
                'param_key' => 'maintenance_banner_message',
                'param_value' => 'Scheduled System Optimization: All services operational. 24/7 fraud hotline 997 is standby.',
                'value_type' => 'string',
                'display_name' => 'Customer Broadcast Notice',
                'description' => 'High-priority advisory message displayed across customer dashboard headers.',
                'updated_by' => 'System Initializer',
            ],
        ];

        foreach ($parameters as $param) {
            \App\Models\SystemParameter::updateOrCreate(
                ['param_key' => $param['param_key']],
                $param
            );
        }
    }
}
