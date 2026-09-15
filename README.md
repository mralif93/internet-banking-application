# BankFlow MY — Enterprise Malaysian Digital Retail Banking Platform

<p align="center">
  <a href="https://mralif93.github.io/internet-banking-application/">
    <img src="https://img.shields.io/badge/Live_Showcase-GitHub_Pages-6366f1?style=for-the-badge&logo=github&logoColor=white" alt="Live Showcase on GitHub Pages">
  </a>
  <img src="https://img.shields.io/badge/Laravel-11%2B%20%2F%2012%2B-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Gateway">
  <img src="https://img.shields.io/badge/Flutter-3.22%2B-02569B?style=for-the-badge&logo=flutter&logoColor=white" alt="Flutter Mobile">
  <img src="https://img.shields.io/badge/PostgreSQL-16%20Cluster-336791?style=for-the-badge&logo=postgresql&logoColor=white" alt="PostgreSQL 16">
  <img src="https://img.shields.io/badge/SQLite-3.42%2B%20(Local%20%26%20CI)-003B57?style=for-the-badge&logo=sqlite&logoColor=white" alt="SQLite 3">
  <img src="https://img.shields.io/badge/Regulatory-BNM%20RMiT%20Compliant-emerald?style=for-the-badge&logo=shield" alt="BNM RMiT Compliant">
  <img src="https://img.shields.io/badge/PayNet-DuitNow%20%7C%20JomPAY-blue?style=for-the-badge&logo=contactlesspayment" alt="PayNet Certified">
</p>

---

## 🌐 Live Architecture Showcase & Operational Specifications
Explore the interactive architecture, sequence flows, regulatory matrices, and technical documentation deployed on GitHub Pages:  
👉 **[https://mralif93.github.io/internet-banking-application/](https://mralif93.github.io/internet-banking-application/)**

Interactive sandboxes & architectural specifications include:
- 📱 **Mobile Hardware Enclave & eKYC Flow Simulator** (Dual biometric capture, EC P-256 keypair generation, and 12-hour cooling-off lock)
- 💳 **PayNet Instant Clearing & QR Engine** (DuitNow Proxy lookup, EMVCo dynamic tag parser, PromptPay/NETS cross-border FX converter)
- 🔏 **Out-of-Band (OOB) Push Token Handshake** (90-second cryptographic challenge signer replacing legacy SMS OTP)
- 🧾 **Multi-Biller JomPAY Batch Settlement Console** (Staged multi-utility bill payments with single consolidated push signature)
- 🛑 **Universal Emergency Kill Switch Circuit Breaker** (Immediate token revocation, CBS debit card block, and direct NSRC 997 hotline linking)
- 🏛️ **Certified 84-Month e-Statement Archive** (PostgreSQL temporal partition pruning, Adobe CDS X.509 cryptographic signing, and LHDN tax export)

---

## 📋 System Overview & Dual-Channel Architecture

**BankFlow MY** is a personal retail digital banking ecosystem engineered in strict compliance with **Bank Negara Malaysia (BNM) Risk Management in Technology (RMiT)** directives, the **Financial Services Act 2013 (FSA)**, and **PayNet Operational Guidelines**. 

The system delivers unified banking services across two purpose-built client channels orchestrated through an asynchronous core services and ledger gateway:

```text
+-----------------------------------------------------------------------------------------------+
|                                       CLIENT CHANNELS                                         |
|                                                                                               |
|  [ Flutter Mobile Application (iOS & Android) ]             [ Laravel Web Portal (Inertia/Vue)]
|  - Cryptographic Identity Token (Enclave Keys)              - Bulk Settlements & Multi-JomPAY |
|  - Biometric eKYC & 3D Liveness Capture                     - Multi-Year Certified Statements |
|  - DuitNow QR Camera Scanner / Dynamic Presenter            - Financial Management Console    |
|  - Out-of-Band (OOB) Push Challenge Signer                  - Emergency Web Kill Switch       |
|  - In-App Emergency Kill Switch & NSRC Link                 - DuitNow NAD Proxy Manager       |
+-----------------------------------------------------------------------------------------------+
                                 │                                          │
                                 ▼ (mTLS / Public Key Pinning)              ▼ (Session / HTTPS Strict)
+-----------------------------------------------------------------------------------------------+
|                                LARAVEL APPLICATION GATEWAY                                    |
|            (Authentication, Orchestration, Cooling-Off Engine, Ledger Integrity)             |
|                                                                                               |
|  - Eloquent ORM + Repository Pattern             - Asynchronous Workers (Laravel Horizon)     |
|  - Asymmetric Sanctum / JWT Auth                 - Redis Cache & Circuit Breaker              |
|  - BNM 12h Cooling-Off State Machine             - Double-Entry Ledger Engine                 |
+-----------------------------------------------------------------------------------------------+
                                 │
                 ┌───────────────┴───────────────┐
                 ▼                               ▼
+--------------------------------+ +--------------------------------+
|     DATA PERSISTENCE TIER      | |      PAYNET CLEARING RAILS     |
|  - Production: PostgreSQL 16   | |  - DuitNow Transfer (NAD)      |
|    * Monthly Partitioning      | |  - DuitNow QR (National/ASEAN) |
|    * Row-Level Locks & WORM    | |  - JomPAY Biller Clearing      |
|  - Local/CI: SQLite 3 (:mem:)  | |  - FPX Payment Gateway         |
+--------------------------------+ +--------------------------------+
```

> [!IMPORTANT]
> **BNM RMiT & 5 Anti-Scam Policy Mandates**:
> 1. **Single Bound Mobile Device**: Only one mobile hardware token can be bound per retail profile (`device_bindings`), holding an EC P-256 non-exportable keypair generated inside Apple Secure Enclave or Android Keystore.
> 2. **12-Hour Cooling-Off Window**: Mandatory 12-hour operational cooling-off applied automatically upon new device registration or transaction limit escalation.
> 3. **SMS OTP Deprecation**: Replaced universally with out-of-band (OOB) biometric push token authorizations.
> 4. **Emergency Kill Switch**: Accessible via mobile and desktop web portal with password fallback to instantly freeze accounts, revoke sessions, and suspend debit cards.
> 5. **Immutable Financial Audit Trail**: Tamper-evident cryptographic hash chain (`SHA-256`) with database triggers prohibiting updates or deletions on `audit_logs`.

---

## 📌 Regulatory & Financial Standards Compliance

| Regulatory Authority / Standard | Statutory Section / Directive | Technical Implementation in BankFlow MY |
| :--- | :--- | :--- |
| **Bank Negara Malaysia (BNM)** | RMiT Standard 10.49 | Strict 1-device binding enforcement via hardware UUID and Secure Enclave public key registration. |
| **Bank Negara Malaysia (BNM)** | RMiT Standard 10.50 | Out-of-band (OOB) multi-factor push authentication for all high-risk web portal operations. |
| **Bank Negara Malaysia (BNM)** | RMiT Standard 10.51 | Complete deprecation of SMS OTP; replaced with hardware-signed asymmetric challenge nonces. |
| **Bank Negara Malaysia (BNM)** | 5 Mandatory Anti-Scam Measures | Automated 12-hour cooling-off state machine, universal Kill Switch circuit breaker, 24/7 NSRC 997 hotlink. |
| **PayNet Malaysia** | DuitNow & NAD Specs | ISO 20022 `pain.001` / `pacs.008` message structure with real-time proxy recipient name verification. |
| **PayNet Malaysia** | JomPAY Operational Rules | Real-time biller validation against `jompay_billers`, automated batch reconciliation, and PDF receipts. |
| **FSA 2013 / IFSA 2013** | Statutory Record Retention | 84-month (7 statutory years) transaction ledger retention leveraging PostgreSQL range-partition pruning. |
| **PDPA 2010** | Personal Data Protection | AES-256-GCM application encryption on NRIC and PII with salted deterministic HMAC-SHA256 blind indexing. |

---

## 🧩 Channel Feature Allocation Matrix

| Functional Module | Flutter Mobile Client | Laravel Web Portal | Operational Details & Hardware Interoperability |
| :--- | :---: | :---: | :--- |
| **Single Device Registration** | **Primary** | N/A | Generates non-exportable EC P-256 keypair in iOS Secure Enclave / Android Keystore. |
| **Biometric Authentication** | **Yes** | No | Interfaced via `local_auth` (`BIOMETRIC_STRONG`), triggering Face ID / Fingerprint challenge. |
| **Out-of-Band (OOB) Soft Token** | **Signer** | **Requester** | Web portal dispatches challenge; mobile receives push and signs 90s nonce. |
| **Emergency Kill Switch** | **Yes** | **Yes** | 1-tap in-app lock on mobile; authenticated web password fallback if phone is lost/stolen. |
| **12-Hour Cooling-Off Banner** | **Yes** | **Yes** | Persistent, non-dismissible countdown timer displaying remaining cooldown duration. |
| **Mobile RASP & Anti-Tamper** | **Yes** | N/A | `FLAG_SECURE` screen protection, dynamic privacy blur, root/jailbreak/Frida detection. |
| **DuitNow Proxy Transfer** | **Yes** | **Yes** | Transfers using Mobile Number, MyKad NRIC, Passport, Army/Police ID, or BRN. |
| **DuitNow QR (Scan to Pay)** | **Yes** | No | Native camera feed decodes EMVCo QR tags with real-time PromptPay/NETS/QRIS FX rates. |
| **DuitNow QR (Dynamic Presenter)**| **Yes** | No | Generates dynamic EMVCo QR with embedded proxy ID, amount, and expiry timestamp. |
| **JomPAY Bill Payment** | Single Pay | **Batch (Up to 20)** | Web portal optimized for multi-utility staging; authorized via single mobile push token. |
| **Certified Tax e-Statements** | View Summary | **Download (.PDF)** | Web serves official LHDN/tax PDFs digitally signed with Adobe CDS X.509 HSM certificates. |
| **Structured Financial Exports** | No | **CSV / OFX / XLSX** | High-performance streaming exports for personal accounting and corporate reconciliation. |
| **Islamic Banking (Shariah)** | **Yes** | **Yes** | Segregated Wadiah/Tawarruq chart of accounts, Tabung Haji integration, and state Zakat calculators. |

---

## 🗄️ Database Architecture & Dual-Engine Strategy

BankFlow MY implements a dual-database architecture ensuring maximum developer agility locally and enterprise reliability in production:

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

- **Double-Entry Ledger Integrity:** All balance changes record balanced debit/credit rows in `journal_entries`. Account balances are updated inside serialized database transactions with row-level locks:
  ```sql
  SELECT id, available_balance, ledger_balance FROM ledger_accounts WHERE id = :accountId FOR UPDATE;
  ```
- **PostgreSQL 16 (Production):** Declarative range partitioning by month (`RANGE (created_at)`) on `transactions` and `audit_logs` for sub-second queries across 84-month archives, backed by PostgreSQL triggers guaranteeing non-updatable, non-deletable audit trails.
- **SQLite 3 (Local & CI):** Standard portable Laravel migrations (`Blueprint`) running in-memory (`:memory:`) with `PRAGMA foreign_keys = ON;` and application-level PII encryption via Eloquent casts (`'encrypted'`).

---

## 🚀 Quick Start (Local Setup)

### Prerequisites
- **PHP 8.3+** with extensions: `pdo`, `sqlite3`, `pgsql`, `bcmath`, `sodium`, `intl`
- **Composer 2.7+**
- **Node.js 20+** & **npm**
- **Flutter SDK 3.22+** (for Mobile Client development)

### 1. Web Portal & API Gateway Setup
```bash
# Clone repository
git clone https://github.com/mralif93/internet-banking-application.git
cd internet-banking-application/web

# Install backend dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Execute migrations and seeders (SQLite for local dev)
touch database/database.sqlite
php artisan migrate --seed

# Install frontend dependencies and compile assets
npm install
npm run build

# Launch development services
php artisan serve --port=8000
```

### 2. Running Automated Test Suites
```bash
cd web

# Run fast unit & feature tests with in-memory SQLite
php artisan test

# Verify code formatting and linting
./vendor/bin/pint --test
```

---

## 🧪 Comprehensive Testing & VAPT Verification Suites

The system is tested according to ISO/IEC/IEEE 29119 and CREST Defensible Security standards:

| Test / Pentest ID | Testing Target | Attack / Verification Methodology | Expected Defensive Behavior |
| :--- | :--- | :--- | :--- |
| **TC-SEC-001** | Device Binding | Register new device for active user profile. | Prior device revoked; 12-hour cooling-off initialized immediately. |
| **TC-SEC-002** | Cooling-Off Enforce | Attempt outward transfer during cooling-off window. | Intercepted with HTTP 403 (`ERR_COOLING_OFF_ACTIVE`); balance unaffected. |
| **TC-DAT-001** | Double-Spend Check | Dispatch 30 concurrent transfer requests in 10ms. | Pessimistic `FOR UPDATE` lock serializes requests; exactly 1 succeeds. |
| **PEN-MOB-01** | Dynamic SSL Pinning | Inject Frida scripts hooking BoringSSL in Flutter ARM64 binary. | `Dio` rejects handshake; app aborts TLS negotiation immediately. |
| **PEN-MOB-03** | RASP Anti-Tamper | Launch Flutter app on Magisk-rooted device with debugger. | `freeRASP` triggers immediate memory wipe and terminates process in $\le 500\text{ ms}$. |
| **PEN-WEB-01** | BOLA / IDOR Defense | Intercept and swap user account UUID in statement download API. | `StatementPolicy` rejects access with HTTP 403 Forbidden; logs event in `audit_logs`. |

---

## 📚 Technical Documentation Index

Complete architectural and operational specifications are maintained in the [`docs/`](docs/) directory:

- 📋 **[Software Requirements Specification (SRS)](docs/software-requirement-specifications.md)** — Comprehensive ISO 29148 requirements, functional specifications (FR-MOB, FR-WEB, FR-SEC, FR-PAY, FR-ISL), and non-functional compliance standards.
- 🗄️ **[Database Architecture & Schema Specification](docs/database-architecture-schema-specification.md)** — Entity-relationship models, full 9-table schema dictionaries, PostgreSQL monthly range partitioning, and audit log immutability triggers.
- 🔄 **[User Workflows & Sequence Specifications](docs/user-workflows-sequences-specifications.md)** — Architectural channel separation, detailed step-by-step executions, ASCII sequence flows, and cross-channel traceability matrices.
- 🧪 **[Software Test Plan (STP)](docs/software-test-plans.md)** — Testing pyramid, technology test matrix, regulatory test cases, and Grey-Box OWASP MASVS / Web API penetration testing verification suites.

---

## 📄 License
This project is open-sourced software licensed under the [MIT License](LICENSE).
