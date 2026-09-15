# Database Architecture & Schema Specification
## Malaysian Personal Retail Digital Banking Ecosystem

- **Target Engines:** PostgreSQL 16+ (Staging & Production) | SQLite 3.42+ (Local Development & CI)
- **ORM Framework:** Laravel 11+ Eloquent
- **Regulatory Compliance:** Bank Negara Malaysia (BNM) RMiT, FSA 2013, PDPA 2010, PayNet Operational Rules
- **Document Version:** 1.0.0

---

## 1. Architectural Principles & Dual-Engine Strategy

To maintain seamless developer experience locally and ironclad reliability in production, this database design adheres to the following principles:

- **Portability via Laravel Schema Builder:**
  All shared schemas are defined using Laravel's `$table` Blueprint methods to ensure 100% interoperability between SQLite and PostgreSQL.
  Engine-specific features (such as PostgreSQL declarative range partitioning and row-level security triggers) are isolated in conditional migration blocks checking `DB::getDriverName() === 'pgsql'`.

- **Immutable Double-Entry Ledger:**
  Money is never represented as a single mutable balance field alone. All financial movements record balanced debit and credit entries in an append-only `journal_entries` table.
  Account balances are updated within serialized database transactions utilizing `SELECT ... FOR UPDATE` row locks to prevent race conditions and double-spending.

- **Cryptographic Protection of PII (PDPA & BNM RMiT):**
  Sensitive personal identifiers (e.g., Malaysian NRIC numbers, phone numbers, passport numbers) are encrypted at the application level using Laravel's AES-256-GCM Eloquent casts (`'encrypted'`).
  To enable rapid lookups without decrypting the entire table, a one-way deterministic blind index (`nric_hash`, computed as $\text{HMAC-SHA256}(\text{NRIC}, \text{APP\_KEY})$) is stored and indexed.

- **Foreign Key Enforcement:**
  In local SQLite environments, foreign key integrity is enforced on boot:

  ```php
  if (DB::getDriverName() === 'sqlite') {
      DB::statement('PRAGMA foreign_keys = ON;');
  }
  ```

---

## 2. Entity-Relationship Overview

```text
+------------------+         1:N         +---------------------+
|      users       | -------------------< |   device_bindings   |
+------------------+                     +---------------------+
        │ 1:1                                       │
        ▼                                           ▼
+------------------+                     +---------------------+
|  user_profiles   |                     | push_authorizations |
+------------------+                     +---------------------+
        │ 1:N
        ▼
+------------------+         1:N         +---------------------+
| ledger_accounts  | -------------------< |   journal_entries   |
+------------------+                     +---------------------+
        │ 1:N                                       │ N:1
        ▼                                           ▼
+------------------+         1:N         +---------------------+
|  duitnow_proxies |                     |    transactions     |
+------------------+                     +---------------------+
                                                    │
                                                    ▼
                                         +---------------------+
                                         |     audit_logs      |
                                         +---------------------+
```

---

## 3. Detailed Table Specifications

### 3.1 Identity, Authentication & Device Security

#### Table: `users`
Represents the core authenticated customer record and global account standing.

| Column | Type | Nullable | Constraints / Index | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | No | Primary Key | RFC 4122 standard UUID. |
| `nric_hash` | VARCHAR(64) | No | Unique Index | Blind index: $\text{HMAC-SHA256}(\text{NRIC})$ for instant lookups. |
| `nric_encrypted` | TEXT | No | None | AES-256-GCM encrypted Malaysian MyKad number. |
| `email_encrypted` | TEXT | No | None | AES-256-GCM encrypted email address. |
| `email_hash` | VARCHAR(64) | No | Index | Blind index: $\text{HMAC-SHA256}(\text{Email})$. |
| `password` | VARCHAR(255) | No | None | Argon2id password hash. |
| `account_status` | VARCHAR(32) | No | Index | `ACTIVE`, `COOLING_OFF`, `SUSPENDED_COMPROMISED`, `DORMANT`. |
| `cooling_off_expires_at` | TIMESTAMPTZ | Yes | Index | Expiration timestamp for BNM mandatory 12-hour cooling-off. |
| `failed_login_attempts` | SMALLINT | No | Default: 0 | Consecutive failed attempts prior to account lockout. |
| `locked_until` | TIMESTAMPTZ | Yes | None | Temporary lockout timestamp. |
| `created_at` | TIMESTAMPTZ | No | None | Record creation timestamp. |
| `updated_at` | TIMESTAMPTZ | No | None | Record update timestamp. |

#### Table: `device_bindings`
Enforces the BNM RMiT mandate of one bound device per retail customer profile.

| Column | Type | Nullable | Constraints / Index | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | No | Primary Key | Binding record identifier. |
| `user_id` | UUID | No | FK $\to$ `users.id` (Cascade) | User reference. |
| `device_uuid` | VARCHAR(128) | No | Unique Index | Unique hardware fingerprint generated by Flutter client. |
| `device_model` | VARCHAR(64) | No | None | e.g., iPhone 15 Pro, Samsung Galaxy S24. |
| `os_version` | VARCHAR(32) | No | None | e.g., iOS 18.1, Android 15. |
| `public_key_pem` | TEXT | No | None | EC P-256 public key generated in hardware Secure Enclave / Keystore. |
| `binding_status` | VARCHAR(32) | No | Index | `ACTIVE`, `REVOKED_SUPERSEDED`, `BLOCKED_TAMPERED`. |
| `app_version` | VARCHAR(16) | No | None | Flutter client build number. |
| `fcm_apns_token` | TEXT | Yes | None | Device token for push notification dispatch. |
| `last_authenticated_at` | TIMESTAMPTZ | Yes | None | Last successful biometric or credential verification. |
| `created_at` | TIMESTAMPTZ | No | None | Binding creation timestamp. |
| `updated_at` | TIMESTAMPTZ | No | None | Update timestamp. |

#### Table: `push_authorizations`
Cryptographic challenge nonces for out-of-band (OOB) push authorization replacing SMS OTP.

| Column | Type | Nullable | Constraints / Index | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | No | Primary Key | Authorization challenge identifier. |
| `user_id` | UUID | No | FK $\to$ `users.id` | User reference. |
| `device_binding_id` | UUID | No | FK $\to$ `device_bindings.id` | Device mandated to sign this challenge. |
| `challenge_nonce` | VARCHAR(64) | No | Unique Index | Cryptographically secure random 256-bit challenge string. |
| `transaction_summary` | JSON | No | None | Details displayed in modal (Amount, Recipient, PayNet Type). |
| `status` | VARCHAR(32) | No | Index | `PENDING`, `APPROVED`, `REJECTED`, `EXPIRED`. |
| `signature_payload` | TEXT | Yes | None | Base64-encoded signature verified against `device_bindings.public_key_pem`. |
| `expires_at` | TIMESTAMPTZ | No | Index | 90-second TTL from issuance. |
| `created_at` | TIMESTAMPTZ | No | None | Challenge issuance timestamp. |

### 3.2 Core Financial & Ledger Engine

#### Table: `ledger_accounts`
Customer deposit, savings, and Shariah-compliant retail accounts.

| Column | Type | Nullable | Constraints / Index | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | No | Primary Key | Account record identifier. |
| `user_id` | UUID | No | FK $\to$ `users.id` | Account owner. |
| `account_number` | VARCHAR(20) | No | Unique Index | Core banking 12- to 16-digit account number. |
| `account_type` | VARCHAR(32) | No | Index | `SAVINGS_CONVENTIONAL`, `SAVINGS_TAWARRUQ`, `CURRENT_WADIAH`. |
| `currency` | VARCHAR(3) | No | Default: `'MYR'` | ISO 4217 currency code. |
| `available_balance` | DECIMAL(15,2) | No | Default: `0.00` | Instantly spendable funds. |
| `ledger_balance` | DECIMAL(15,2) | No | Default: `0.00` | Cleared balance including pending settlement float. |
| `daily_transfer_limit` | DECIMAL(15,2) | No | Default: `5000.00` | Configured daily cap for outward PayNet transfers. |
| `is_primary` | BOOLEAN | No | Default: `false` | Default settlement account for DuitNow incoming funds. |
| `created_at` | TIMESTAMPTZ | No | None | Account creation timestamp. |
| `updated_at` | TIMESTAMPTZ | No | None | Timestamp of last balance calculation. |

#### Table: `transactions`
Parent business transaction metadata linking PayNet rails, web requests, and mobile workflows.

| Column | Type | Nullable | Constraints / Index | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | No | Primary Key | Transaction identifier. |
| `user_id` | UUID | No | FK $\to$ `users.id` | Originating customer. |
| `source_account_id` | UUID | No | FK $\to$ `ledger_accounts.id` | Debited account. |
| `rail` | VARCHAR(32) | No | Index | `DUITNOW_TRANSFER`, `DUITNOW_QR`, `JOMPAY`, `FPX`. |
| `paynet_rrn` | VARCHAR(64) | Yes | Index | PayNet Retrieval Reference Number (ISO 20022 message match). |
| `paynet_end_to_end_id` | VARCHAR(64) | Yes | Index | PayNet EndToEndId for clearing reconciliation. |
| `amount` | DECIMAL(15,2) | No | None | Nominal transfer value in MYR. |
| `fee_amount` | DECIMAL(15,2) | No | Default: `0.00` | Bank or foreign exchange fee. |
| `recipient_proxy_type` | VARCHAR(16) | Yes | None | `MOBILE`, `NRIC`, `PASSPORT`, `ARMY_POLICE`, `BRN`. |
| `recipient_proxy_val` | VARCHAR(64) | Yes | None | Masked recipient lookup value. |
| `recipient_name` | VARCHAR(255) | Yes | None | PayNet verified legal name. |
| `status` | VARCHAR(32) | No | Index | `INITIATED`, `PENDING_AUTH`, `PROCESSING`, `SUCCESS`, `FAILED`, `REVERSED`. |
| `channel` | VARCHAR(16) | No | None | `MOBILE_FLUTTER`, `WEB_LARAVEL`. |
| `ip_address` | VARCHAR(45) | No | None | Client IP (IPv4 or IPv6). |
| `created_at` | TIMESTAMPTZ | No | Index | Transaction timestamp (Used for range partitioning in PG). |
| `updated_at` | TIMESTAMPTZ | No | None | Settlement/failure update timestamp. |

#### Table: `journal_entries`
Immutable double-entry book ledger. Every completed transaction produces at least one balanced debit and credit entry.

| Column | Type | Nullable | Constraints / Index | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGSERIAL / INT | No | Primary Key | Monotonically increasing entry sequence. |
| `transaction_id` | UUID | No | FK $\to$ `transactions.id` | Associated business transaction. |
| `account_id` | UUID | No | FK $\to$ `ledger_accounts.id` | Affected ledger account. |
| `entry_type` | VARCHAR(6) | No | None | `DEBIT` or `CREDIT`. |
| `amount` | DECIMAL(15,2) | No | None | Positive decimal value. |
| `balance_after` | DECIMAL(15,2) | No | None | Running balance after this entry was applied. |
| `narrative` | VARCHAR(255) | No | None | Statement line item description. |
| `created_at` | TIMESTAMPTZ | No | Index | Timestamp of entry posting. |

### 3.3 PayNet Routing & Configuration

#### Table: `duitnow_proxies`
Customer DuitNow proxy registrations connected to PayNet's National Addressing Database (NAD).

| Column | Type | Nullable | Constraints / Index | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | UUID | No | Primary Key | Proxy registration identifier. |
| `user_id` | UUID | No | FK $\to$ `users.id` | Owner of the proxy identifier. |
| `account_id` | UUID | No | FK $\to$ `ledger_accounts.id` | Target receiving account. |
| `proxy_type` | VARCHAR(16) | No | Index | `MOBILE`, `NRIC`, `PASSPORT`, `ARMY_POLICE`. |
| `proxy_value_hash` | VARCHAR(64) | No | Unique Index | Blind index: $\text{HMAC-SHA256}(\text{ProxyValue})$. |
| `proxy_value_enc` | TEXT | No | None | Encrypted proxy string. |
| `status` | VARCHAR(32) | No | Index | `REGISTERED`, `SUSPENDED`, `DEREGISTERED`. |
| `paynet_nad_ref` | VARCHAR(64) | Yes | None | Confirmation token from PayNet NAD switch. |
| `created_at` | TIMESTAMPTZ | No | None | Registration timestamp. |
| `updated_at` | TIMESTAMPTZ | No | None | Modification timestamp. |

#### Table: `jompay_billers`
Cached registry of national billers participating in the JomPAY clearing network.

| Column | Type | Nullable | Constraints / Index | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGSERIAL / INT | No | Primary Key | Identifier. |
| `biller_code` | VARCHAR(10) | No | Unique Index | JomPAY 4- to 5-digit biller code (e.g., `5454` for TNB). |
| `biller_name` | VARCHAR(128) | No | Index | Registered commercial entity name. |
| `ref1_label` | VARCHAR(64) | No | None | Label for Ref-1 input (e.g., Account No, Bill No). |
| `ref2_label` | VARCHAR(64) | Yes | None | Label for Ref-2 input if applicable. |
| `is_active` | BOOLEAN | No | Default: `true` | Biller operational status. |
| `updated_at` | TIMESTAMPTZ | No | None | Cache update timestamp. |

### 3.4 Regulatory Audit Trail (BNM RMiT Compliant)

#### Table: `audit_logs`
Cryptographically chained, append-only log of all critical, regulatory, and high-risk events.

| Column | Type | Nullable | Constraints / Index | Description |
| :--- | :--- | :--- | :--- | :--- |
| `id` | BIGSERIAL / INT | No | Primary Key | Monotonically ascending integer sequence. |
| `event_type` | VARCHAR(64) | No | Index | `KILL_SWITCH_TRIGGERED`, `DEVICE_BOUND`, `LIMIT_RAISED`, `LOGIN_FAILED`. |
| `actor_id` | UUID | Yes | FK $\to$ `users.id` | User or operator responsible for the event. |
| `ip_address` | VARCHAR(45) | No | None | Originating network IP address. |
| `user_agent` | TEXT | No | None | Client browser user-agent or Flutter device footprint. |
| `event_payload` | JSON | No | None | Contextual details (affected IDs, old limit, new limit). |
| `previous_hash` | VARCHAR(64) | No | None | SHA-256 hash of the immediate preceding audit record. |
| `entry_hash` | VARCHAR(64) | No | Unique Index | $\text{SHA-256}(\text{id} + \text{event\_type} + \text{payload} + \text{previous\_hash})$. |
| `created_at` | TIMESTAMPTZ | No | Index | Server timestamp (immutable). |

---

## 4. Production PostgreSQL Engine Hardening & Partitioning

### 4.1 Monthly Range Partitioning on `transactions`

For staging and production PostgreSQL instances, the `transactions` table is created as a partitioned table by range on `created_at` to ensure fast index scans and facilitate data lifecycle management:

```sql
CREATE TABLE transactions (
    id UUID NOT NULL,
    user_id UUID NOT NULL REFERENCES users(id),
    source_account_id UUID NOT NULL REFERENCES ledger_accounts(id),
    rail VARCHAR(32) NOT NULL,
    paynet_rrn VARCHAR(64),
    paynet_end_to_end_id VARCHAR(64),
    amount DECIMAL(15,2) NOT NULL,
    fee_amount DECIMAL(15,2) DEFAULT 0.00,
    recipient_proxy_type VARCHAR(16),
    recipient_proxy_val VARCHAR(64),
    recipient_name VARCHAR(255),
    status VARCHAR(32) NOT NULL,
    channel VARCHAR(16) NOT NULL,
    ip_address VARCHAR(45) NOT NULL,
    created_at TIMESTAMPTZ NOT NULL,
    updated_at TIMESTAMPTZ NOT NULL,
    PRIMARY KEY (id, created_at)
) PARTITION BY RANGE (created_at);

-- Monthly partition template
CREATE TABLE transactions_y2026m09 PARTITION OF transactions
    FOR VALUES FROM ('2026-09-01 00:00:00+00') TO ('2026-10-01 00:00:00+00');
```

### 4.2 Immutable Audit Log Trigger

To guarantee audit trail non-repudiation in production PostgreSQL:

```sql
CREATE OR REPLACE FUNCTION enforce_audit_log_immutability()
RETURNS TRIGGER AS $$
BEGIN
    RAISE EXCEPTION 'Updates and deletions are strictly prohibited on the audit_logs table.';
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trg_audit_logs_immutable
BEFORE UPDATE OR DELETE ON audit_logs
FOR EACH ROW EXECUTE FUNCTION enforce_audit_log_immutability();
```

---

## 5. Laravel Migration Blueprint Implementation

Below is the standard portable Laravel migration illustrating the dual-engine strategy:

```php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nric_hash', 64)->unique();
            $table->text('nric_encrypted');
            $table->text('email_encrypted');
            $table->string('email_hash', 64)->index();
            $table->string('password');
            $table->string('account_status', 32)->default('ACTIVE')->index();
            $table->timestampTz('cooling_off_expires_at')->nullable()->index();
            $table->unsignedSmallInteger('failed_login_attempts')->default(0);
            $table->timestampTz('locked_until')->nullable();
            $table->timestampsTz();
        });

        // 2. Device Bindings Table
        Schema::create('device_bindings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('device_uuid', 128)->unique();
            $table->string('device_model', 64);
            $table->string('os_version', 32);
            $table->text('public_key_pem');
            $table->string('binding_status', 32)->default('ACTIVE')->index();
            $table->string('app_version', 16);
            $table->text('fcm_apns_token')->nullable();
            $table->timestampTz('last_authenticated_at')->nullable();
            $table->timestampsTz();
        });

        // 3. Ledger Accounts Table
        Schema::create('ledger_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users');
            $table->string('account_number', 20)->unique();
            $table->string('account_type', 32)->index();
            $table->string('currency', 3)->default('MYR');
            $table->decimal('available_balance', 15, 2)->default(0.00);
            $table->decimal('ledger_balance', 15, 2)->default(0.00);
            $table->decimal('daily_transfer_limit', 15, 2)->default(5000.00);
            $table->boolean('is_primary')->default(false);
            $table->timestampsTz();
        });

        // 4. Immutable Audit Logs Table
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('event_type', 64)->index();
            $table->foreignUuid('actor_id')->nullable()->constrained('users');
            $table->string('ip_address', 45);
            $table->text('user_agent');
            $table->json('event_payload');
            $table->string('previous_hash', 64);
            $table->string('entry_hash', 64)->unique();
            $table->timestampTz('created_at')->useCurrent()->index();
        });

        // 5. PostgreSQL-Specific Hardening
        if (DB::getDriverName() === 'pgsql') {
            DB::unprepared("
                CREATE OR REPLACE FUNCTION prevent_audit_tampering()
                RETURNS TRIGGER AS $$
                BEGIN
                    RAISE EXCEPTION 'Audit logs cannot be updated or deleted.';
                END;
                $$ LANGUAGE plpgsql;

                CREATE TRIGGER trg_audit_immutable
                BEFORE UPDATE OR DELETE ON audit_logs
                FOR EACH ROW EXECUTE FUNCTION prevent_audit_tampering();
            ");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::unprepared("DROP TRIGGER IF EXISTS trg_audit_immutable ON audit_logs;");
            DB::unprepared("DROP FUNCTION IF EXISTS prevent_audit_tampering();");
        }

        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('ledger_accounts');
        Schema::dropIfExists('device_bindings');
        Schema::dropIfExists('users');
    }
};
```

