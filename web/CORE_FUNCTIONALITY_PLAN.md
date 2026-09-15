# BankFlow MY — Core Functionality Architecture & Implementation Plan

> **Status**: Ready for Implementation  
> **Target Environment**: Laravel 11/12 + PHP 8.3 + SQLite (Local) / PostgreSQL (Production)  
> **Design Consistency**: Preserves Tailwind CSS v4 design system, dark mode, and micro-animations.

---

## 1. Executive Summary & Goals

The BankFlow MY web portal has a completed high-fidelity interface for retail internet banking. In this phase, we transition from simulated/mock UI state to an **active core financial engine**.

Key targets:
- **Immutable Double-Entry Ledger**: Atomic transactions wrapped in `DB::transaction()` with `lockForUpdate()` pessimistic locking.
- **PayNet DuitNow Instant Transfer**: Account-to-account, DuitNow ID resolution, and Bank Negara Malaysia (BNM) 12-hour cooling-off enforcement for new payees or high amounts.
- **JomPAY Bill Payment Engine**: Biller lookup (e.g. TNB 5454, Air Selangor 8888, Unifi), Ref-1/Ref-2 validation, single & batch payment settlement.
- **DuitNow QR Pay**: Instant QR payment simulation with merchant decoding.
- **Certified e-Statements**: Monthly balance aggregation (Opening balance, Debits, Credits, Closing balance) with printable/PDF format.
- **Emergency Web Kill Switch & Security**: Immediate account freezing with password authentication, session revocation, and daily transaction limit enforcement.

---

## 2. Database Schema & Architecture

### Tables & Relationships
```text
┌────────────────┐       1:M       ┌─────────────────┐       1:M       ┌──────────────────┐
│   customers    │────────────────▶│    accounts     │────────────────▶│   transactions   │
└────────────────┘                 └─────────────────┘                 └──────────────────┘
        │ 1:M                              │ 1:M
        ├────────────────▶ [beneficiaries] └────────────────▶ [cards]
        ├────────────────▶ [transaction_limits]
        └────────────────▶ [audit_logs]

┌──────────────────┐
│  jompay_billers  │ (Master biller directory)
└──────────────────┘
```

### Table Breakdown
1. **`accounts`**:
   - `id`, `customer_id`, `account_number`, `account_type` (`savings`, `current`), `account_name`, `currency` (`MYR`), `balance`, `available_balance`, `status` (`active`, `frozen`, `dormant`), timestamps.
2. **`transactions`**:
   - `id`, `reference_number` (e.g. `TRX-20260915-XXXX`), `account_id`, `transaction_type` (`duitnow_transfer`, `jompay`, `qr_pay`, `fpx`, `deposit`), `direction` (`debit`, `credit`), `amount`, `fee`, `recipient_name`, `recipient_bank`, `recipient_account`, `payment_reference`, `biller_code`, `biller_name`, `ref_1`, `ref_2`, `status` (`completed`, `cooling_off`, `pending`, `failed`), `cooling_off_until`, `balance_after`, `description`, `metadata` (JSON), timestamps.
3. **`beneficiaries`**:
   - `id`, `customer_id`, `nickname`, `account_number`, `bank_name`, `duitnow_id_type`, `duitnow_id_value`, `is_favorite`, `last_transferred_at`, timestamps.
4. **`jompay_billers`**:
   - `id`, `biller_code` (e.g., `5454`, `8888`, `2222`), `biller_name`, `category`, `ref_1_label`, `ref_2_label`, `is_ref_2_required`, timestamps.
5. **`transaction_limits`**:
   - `id`, `customer_id`, `limit_type` (`duitnow`, `jompay`, `qr_pay`, `fpx`, `atm_withdrawal`), `daily_limit`, `spent_today`, `last_reset_date`, timestamps.
6. **`cards`**:
   - `id`, `customer_id`, `account_id`, `card_number_masked`, `card_holder_name`, `card_type`, `expiry_month`, `expiry_year`, `status` (`active`, `frozen`), `is_overseas_enabled`, `is_online_enabled`, `is_contactless_enabled`, `daily_purchase_limit`, timestamps.
7. **`audit_logs`**:
   - `id`, `customer_id`, `event`, `ip_address`, `user_agent`, `payload` (JSON), `created_at`.

---

## 3. Core Domain Services

1. **`LedgerService`** (`app/Services/LedgerService.php`):
   - Executes atomic money movements using `DB::transaction()` and pessimistic locking (`lockForUpdate()`).
   - Ensures no overdraft beyond `available_balance`.
   - Generates unique PayNet-compliant reference IDs.
   - Calculates `balance_after` and persists transaction history records.

2. **`TransferService`** (`app/Services/TransferService.php`):
   - Validates recipient information (internal BankFlow account vs external bank via DuitNow simulation).
   - Validates daily limits via `TransactionLimitService`.
   - Checks BNM cooling-off condition: transfers $\ge$ RM 1,000 to new payees within 12 hours are placed on `cooling_off` hold.
   - Dispatches transaction and updates saved beneficiary `last_transferred_at`.

3. **`JomPayService`** (`app/Services/JomPayService.php`):
   - Looks up biller in `jompay_billers`.
   - Validates Ref-1 and optional Ref-2.
   - Executes single or batch payments atomically.

4. **`StatementService`** (`app/Services/StatementService.php`):
   - Aggregates monthly opening balance, incoming credits, outgoing debits, and closing balance.
   - Formats statements for standard printing or PDF download.

5. **`SecurityService`** (`app/Services/SecurityService.php`):
   - **Emergency Kill Switch**: Verifies customer password, locks account immediately (`status = 'frozen'`), terminates all other sessions, and logs audit record.
   - Daily Limit Updates: Updates customer daily spending caps.

---

## 4. Phased Implementation Roadmap

### Phase 1: Migrations, Models & Realistic Seeders
- Create migrations for `accounts`, `transactions`, `beneficiaries`, `jompay_billers`, `transaction_limits`, `cards`, and `audit_logs`.
- Define Eloquent relationships on `Customer` model:
  - `hasMany(Account::class)`
  - `hasManyThrough(Transaction::class, Account::class)`
  - `hasMany(Beneficiary::class)`
  - `hasMany(TransactionLimit::class)`
  - `hasMany(Card::class)`
  - `hasMany(AuditLog::class)`
- Create `DatabaseSeeder` with realistic Malaysian banking data (test customer, savings account with RM 24,850.50, preloaded transaction history, TNB/Air Selangor/Unifi billers, and debit card).

### Phase 2: Core Domain Services & Business Logic
- Implement `LedgerService`, `TransferService`, `JomPayService`, `TransactionLimitService`, and `SecurityService`.
- Unit & feature tests for ledger safety (locking, preventing balance race conditions).

### Phase 3: Web Controllers & Routes
- Implement Controllers:
  - `TransferController` (`show`, `submitTransfer`, `quickPayee`)
  - `JomPayController` (`show`, `validateBiller`, `submitBill`)
  - `QrPayController` (`show`, `decodeQr`, `submitPayment`)
  - `StatementController` (`show`, `downloadPdf`)
  - `HistoryController` (`index`, `showDetail`, `filter`)
  - `SettingsController` (`index`, `updateLimits`, `activateKillSwitch`, `updatePassword`)
- Update `routes/web.php` with named POST and GET endpoints.

### Phase 4: Blade View Integration
- Connect existing Blade views to controllers:
  - Dynamically display authenticated customer's account balance, account number, and transactions.
  - Bind the transfer form to `/customer/transfer` with validation errors and success receipt modal.
  - Bind JomPAY to biller lookup and submit.
  - Wire up the Kill Switch modal to post password and trigger account lockdown.

### Phase 5: Testing, Validation & Verification
- Run `php artisan test` covering:
  - Transfer execution & balance deduction
  - Insufficient funds handling
  - JomPAY bill payment validation
  - Emergency Kill Switch execution
- Verify interactive flows in the browser on `http://localhost:8007`.
