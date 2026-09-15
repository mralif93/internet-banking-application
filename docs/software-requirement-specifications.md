# Software Requirements Specification (SRS)
## Next-Generation Malaysian Personal Retail Digital Banking (Web & Mobile)

- **Document Version:** 2.3.0
- **Compliance Standard:** ISO/IEC/IEEE 29148:2018
- **Technology Stack:** Flutter (Mobile), Laravel 11+ (Web Portal & Backend Services), PostgreSQL 16+ (Production DB), SQLite 3 (Local Development & CI Test DB)
- **Regulatory Framework:** Bank Negara Malaysia (BNM) Policy Document on Risk Management in Technology (RMiT), Financial Services Act 2013 (FSA), Islamic Financial Services Act 2013 (IFSA), Personal Data Protection Act 2010 (PDPA)

---

## 1. Introduction

### 1.1 Purpose

This Software Requirements Specification (SRS) establishes the functional, behavioral, architectural, and compliance requirements for the unified Personal Retail Digital Banking ecosystem. The implementation comprises a cross-platform Flutter native mobile application, a secure Laravel web portal and API gateway layer, and an enterprise PostgreSQL database cluster for production with SQLite for zero-dependency local development and rapid local testing. This specification serves as the formal baseline for development, architecture, quality assurance, regulatory audits by Bank Negara Malaysia (BNM), and PayNet certification.

### 1.2 Scope of the System

The system delivers personal retail banking services across two primary client channels supported by a centralized services and data tier:

- **Mobile Banking Application (Flutter - iOS & Android):** Acts as the hardware-bound identity device, primary contactless/P2P payment instrument, and cryptographically secure out-of-band approval token (Soft Token / Secure2u alternative).
- **Internet Banking Web Portal (Laravel Blade / Inertia.js):** Serves as the administrative, record-keeping, bulk-processing, and financial management console.
- **Application & Integration Layer (Laravel 11+ / Octane):** Orchestrates core business workflows, session tokens, audit pipelines, and PayNet clearing connectors.
- **Data Persistence Tier (Dual-Engine Architecture):**
  - **Production Environment (PostgreSQL 16+ Enterprise Cluster):** Enforces strict ACID compliance, encrypted table spaces, append-only financial audit trails via row-level triggers, temporal table partitioning, and multi-zone high-availability streaming replication.
  - **Local & Test Environment (SQLite 3 with Foreign Keys):** Serves isolated in-memory or file-backed database instances for rapid developer onboarding, test-driven development (TDD), and continuous integration runners without heavyweight infrastructure overhead.

### 1.3 Definitions, Acronyms, and Abbreviations

| Term / Acronym | Definition |
| :--- | :--- |
| **BNM** | Bank Negara Malaysia (Central Bank of Malaysia). |
| **RMiT** | Risk Management in Technology guidelines issued by BNM. |
| **PayNet** | Payments Network Malaysia Sdn Bhd. |
| **DuitNow** | PayNet’s instant credit transfer service utilizing Proxy IDs (NRIC, Mobile, Passport, Army/Police ID, BRN). |
| **DuitNow QR** | The unified National QR Standard of Malaysia (interoperable across banks and eWallets). |
| **FPX** | Financial Process Exchange (online payment gateway operated by PayNet). |
| **JomPAY** | PayNet’s national bill payment scheme. |
| **eKYC** | Electronic Know Your Customer identity verification. |
| **OOB** | Out-of-Band authentication. |
| **ORM** | Object-Relational Mapping (Laravel Eloquent). |
| **WAL** | Write-Ahead Logging. |
| **RASP** | Runtime Application Self-Protection. |
| **RPO / RTO** | Recovery Point Objective / Recovery Time Objective. |
| **MTBF / MTTR** | Mean Time Between Failures / Mean Time To Recovery. |

---

## 2. Overall System Description

### 2.1 Product Perspective & Context Architecture

```text
+-------------------------------------------------------------------------------------------------+
|                                          CLIENT TIER                                            |
|  [ Mobile App: Flutter (Dart) ]                          [ Web Portal: Laravel + Inertia/Vue ]  |
|   - iOS: Secure Enclave via MethodChannels                - Responsive UI (Tailwind CSS)        |
|   - Android: Keystore / Play Integrity                   - Session Storage: HttpOnly / Strict   |
|   - Camera (QR / eKYC), Biometrics (`local_auth`)         - Anti-CSRF, Content Security Policy  |
+-------------------------------------------------------------------------------------------------+
                                                │
                                                ▼ (mTLS / TLS 1.3 / Public Key Pinning)
+-------------------------------------------------------------------------------------------------+
|                               API GATEWAY & APPLICATION TIER                                    |
|                                    [ Laravel 11+ Octane ]                                       |
|  - Data Abstraction Layer: Eloquent ORM + Repository Pattern                                    |
|  - WAF / Anti-DDoS Filters / Rate Limiting (Laravel Throttle)                                   |
|  - Token Validation & Session Management (Laravel Sanctum / Passport with Asymmetric JWT)       |
|  - Asynchronous Queues & Event Workers (Laravel Horizon + Redis Cluster)                         |
|  - Services: Device Binding, Cooling-Off State Machine, Kill Switch Circuit Breaker             |
+-------------------------------------------------------------------------------------------------+
                                                │
                 ┌──────────────────────────────┼──────────────────────────────┐
                 ▼                              ▼                              ▼
+--------------------------------+ +---------------------------+ +--------------------------------+
|      DATA PERSISTENCE TIER     | |    PAYNET INTEGRATIONS    | |       CORE / EXTERNAL          |
|  [ Environment-Switchable ]    | | [ ISO 8583 / ISO 20022 ]  | |                                |
|  - PROD: PostgreSQL 16 Cluster | |  - DuitNow Proxy / NAD    | |  - Core Banking System (CBS)   |
|    * Primary + Streaming Read  | |  - DuitNow QR (EMVCo)     | |  - JPN MyKad Verification API  |
|    * Table Partitioning        | |  - JomPAY Biller Engine   | |  - Push Notifications:         |
|    * Row-Level Triggers & PII  | |  - FPX Gateway Redirection| |    APNs (Apple) / FCM (Google) |
|  - LOCAL/CI: SQLite 3 File/Mem | |                           | |                                |
+--------------------------------+ +---------------------------+ +--------------------------------+
```

### 2.2 Technology Stack Specifications

#### 2.2.1 Mobile Client: Flutter
- **Framework:** Flutter SDK 3.22+ (Dart 3.4+) compiling to native ARM64 binaries for iOS and Android.
- **Hardware Interoperability:** Platform MethodChannels interfacing with native Swift (iOS) and Kotlin (Android) modules for:
  - Hardware Keystore access (Android Keystore Provider, iOS Keychain Services with `kSecAccessControlBiometryAny`).
  - Real-time camera streaming for PayNet EMVCo QR decoding and eKYC optical character recognition.
  - Root/Jailbreak, debugger, and emulator dynamic detection via hardened platform bindings.
- **State Management & Network:** BLoC (Business Logic Component) pattern for predictable state transitions, combined with Dio configured for mTLS and certificate pinning.

#### 2.2.2 Web Portal & Application Backend: Laravel
- **Runtime & Framework:** PHP 8.3+ running on Laravel 11+ under Laravel Octane (Swoole / RoadRunner engine) for sub-millisecond execution overhead.
- **Web Frontend:** Laravel Blade paired with Inertia.js and modern client-side reactive components for unified state management without exposing public API endpoints directly to third-party scraping.
- **Authentication Engine:** Laravel Sanctum / Passport utilizing asymmetric RS256 token signing, with access tokens stored strictly in secure, `HttpOnly`, `SameSite=Strict` cookies.
- **Background Queues:** Laravel Horizon overseeing Redis queues for decoupling asynchronous tasks: PayNet ISO 20022 message dispatch, push notifications, and event-driven ledger notifications.

#### 2.2.3 Persistence Tier: Dual Database Architecture
- **Production Database Engine: PostgreSQL 16 Enterprise Cluster**
  - High-availability streaming replication managed via Patroni with PgBouncer connection pooling.
  - **Storage Encryption:** Transparent Data Encryption (TDE) / encrypted volumes at rest (AES-256), and column-level encryption for sensitive Personal Identifiable Information (PII) using PostgreSQL's `pgcrypto` module.
  - Temporal partitioned tables (`RANGE (created_at)`) for monthly transaction archiving.
  - Enforced row-level security and non-updatable/non-deletable trigger constraints on audit log tables.
- **Local Development & CI Engine: SQLite 3**
  - SQLite 3.42+ utilized locally (`database.sqlite`) or as in-memory databases (`:memory:`) for automated test runs.
  - Foreign key constraints strictly activated on every database connection via Laravel configuration (`PRAGMA foreign_keys = ON;`).
  - Schema definition abstraction maintained strictly through standardized Laravel migrations (Blueprint), prohibiting raw, non-portable SQL dialects in shared migrations.
  - **Native driver emulation:** Application-level AES-256 encryption via Laravel Eloquent Casts (`casts => ['nric' => 'encrypted']`) to ensure identical PII encryption functionality across both SQLite locally and PostgreSQL in production without database-specific syntax dependencies.

### 2.3 User Classes and Characteristics
- **Standard Retail Customer:** Individuals aged 18+ holding savings/current accounts, debit/credit cards, or financing facilities.
- **Bank Operations & Fraud Analyst (Internal):** Administrative personnel overseeing real-time transaction monitoring, AML/CFT alerts, cooling-off status, and emergency Kill Switch actions via a restricted internal Laravel Nova / Filament admin interface.

### 2.4 Channel Feature Matrix & Functional Allocation

The retail banking system divides functional capabilities between the Flutter mobile application and the Laravel web portal according to user context, hardware capabilities, and regulatory mandates:

| Feature Category | Specific Capability / Module | Mobile App (Flutter) | Web Portal (Laravel) | Description & Operational Distinction |
| :--- | :--- | :--- | :--- | :--- |
| **Authentication & Security** | Single Device Binding (Enclave) | Primary | N/A | Mobile creates and stores EC P-256 keypair in hardware enclave. |
| | Biometric Login (Face / Fingerprint) | Yes | No | Flutter `local_auth` interfaces with native biometric hardware. |
| | Push-Based Soft Token (Secure2u) | Signer | Requester | Web triggers challenge; mobile receives push, verifies, and signs. |
| | Emergency Kill Switch | Yes | Yes | Mobile: 1-tap in-app lock; Web: password fallback if phone is lost. |
| | 12-Hour Cooling-Off Countdown | Yes | Yes | Visible on both channels upon new device binding or limit raise. |
| | Anti-Screen Capture & RASP | Yes | N/A | `FLAG_SECURE` on Android, privacy blur on iOS, root/debugger block. |
| **Payments & Transfers** | DuitNow Proxy Transfer | Yes | Yes | Transfer using Mobile Number, NRIC, Passport, or Army ID. |
| | DuitNow QR (Scan to Pay) | Yes | No | Mobile camera scans merchant EMVCo QR code. |
| | DuitNow QR (P2P Receive Generator) | Yes | No | Mobile generates dynamic QR with embedded amount and proxy ID. |
| | Bilateral Cross-Border QR | Yes | No | Instant conversion and checkout (PromptPay, NETS, QRIS). |
| | JomPAY Bill Payment | Single Pay | Batch (Up to 20) | Web optimized for multiple bill staging; single mobile push sign. |
| | PayNet FPX Merchant Checkout | Deep Link | Redirect Gateway | Web directs to checkout; mobile handles push authorization. |
| | Scheduled & Recurring Transfers | View / Cancel | Create / Manage | Complex scheduling and mandate management hosted on Web. |
| **Account & Card Controls** | Real-Time Debit Card Toggles | Yes | Yes | Toggle overseas ATM, e-commerce, contactless spending limits. |
| | Daily Limit Revisions | Request | Request | Subject to mandatory 12-hour cooling-off state machine. |
| | Micro-Savings ("Pockets / Tabung") | Primary | View Only | Automated debit round-ups, goal trackers, and micro-vaults. |
| | DuitNow NAD Proxy Registration | View / Change | Comprehensive | Link, modify, or unlink multiple proxies to ledger accounts. |
| **Documents & Reporting** | Balance Inquiry & Recent Activity | Yes (90 Days) | Yes (Full) | Mobile optimized for quick glance; Web for exhaustive history. |
| | Certified e-Statements (84 Months) | View Summary | Download (.PDF) | Web serves official LHDN/tax PDFs with X.509 digital signatures. |
| | Structured Financial Exports | No | CSV / OFX / Excel | Direct database streaming for tax calculation or personal ledger. |
| **Islamic Banking** | Tabung Haji Linkage | Balance / Transfer | Full Registration | Link TH account, check balances, execute direct deposits. |
| | Zakat Assessment & Settlement | Direct Payout | Full Calculator | Detailed wealth/gold calculator with amil routing (PPZ, LZS). |
| | Shariah Disclosures & Profit Rates | Yes | Yes | Strict display of Wadiah, Tawarruq, and Murabahah contracts. |

---

## 3. Specific System Features & Functional Requirements

### 3.1 Mobile-Exclusive & Mobile-Centric Functional Requirements (Flutter)

#### FR-MOB-01: Hardware-Enclave Device Binding
- The Flutter client shall generate a non-exportable 256-bit elliptic curve keypair (`secp256r1`) inside the hardware Secure Enclave (iOS) or Android Keystore with `KeyProperties.PURPOSE_SIGN`.
- The application shall communicate public keys and device telemetry to Laravel via `/api/v1/devices/bind`.
- The client shall reject execution if hardware-backed key generation is unavailable.

#### FR-MOB-02: Native Biometric Authentication & Step-Up Security
- The mobile app shall authenticate users via `local_auth` binding to iOS `LAContext` and Android `BiometricPrompt` (`BIOMETRIC_STRONG`).
- Transactions exceeding MYR 250.00 shall prompt mandatory step-up biometric re-authentication prior to cryptographic enclave signing.

#### FR-MOB-03: DuitNow EMVCo QR Camera Scanner
- The Flutter app shall embed a native camera feed decoding EMVCo QR standards in real time.
- The client shall extract Tag 26 (Merchant ID), Tag 53 (Currency Code), and Tag 54 (Amount).
- For bilateral cross-border payments (Thailand PromptPay, Singapore NETS, Indonesia QRIS), the app shall call `/api/v1/paynet/fx-quote` and display the foreign amount alongside the calculated MYR deduction prior to confirmation.

#### FR-MOB-04: Peer-to-Peer (P2P) Dynamic QR Presenter
The Flutter client shall generate dynamic EMVCo-compliant QR codes displaying the user's primary DuitNow proxy identifier, an optional preset amount, and an expiration timestamp.

#### FR-MOB-05: Real-Time Debit Card Control Center
The Flutter app shall provide instantaneous toggle switches for:
- Overseas ATM cash withdrawal.
- Online / card-not-present e-commerce transactions.
- Contactless (PINless payWave) transaction limits.
- Temporary freeze / unfreeze of physical cards.
Toggles shall immediately trigger an asynchronous API call updating card profile parameters in the Core Banking System.

#### FR-MOB-06: Micro-Savings "Pockets / Tabung" Engine
- The mobile app shall allow retail users to partition their primary savings account balance into distinct goal buckets ("Pockets").
- The app shall support automated round-up logic: rounding debit card purchases to the nearest Ringgit and allocating the spare change to a selected pocket.

#### FR-MOB-07: Mobile Application Self-Protection (RASP) & Privacy Defense
- The Flutter client shall enforce `FLAG_SECURE` on Android window managers to prevent screenshots, screen mirroring, and recording.
- On iOS, the application shall render an opaque privacy blur view covering sensitive account balances whenever the app enters background or app-switcher states.
- The app shall terminate instantly upon detecting root, jailbreak, Frida/Xposed hooking frameworks, emulators, or attached debuggers.

### 3.2 Web-Exclusive & Web-Centric Functional Requirements (Laravel)

#### FR-WEB-01: Multi-Biller JomPAY Batch Settlement Console
- The Laravel web portal (Inertia.js) shall provide a batch billing table allowing users to stage up to twenty (20) distinct JomPAY bill settlements simultaneously.
- The portal shall validate Biller Codes, Ref-1 formats, and Ref-2 values via client-side and backend validation routines against the `jompay_billers` table.
- The backend shall consolidate the entire batch into a single push authorization challenge sent to the customer's bound Flutter mobile device.

#### FR-WEB-02: Certified Multi-Year e-Statement Archive (84 Months)
- The web portal shall render an interactive archive interface supporting retrieval of account statements spanning eighty-four (84) months (7 statutory years).
- The Laravel backend shall query range-partitioned tables in PostgreSQL based on statement dates to optimize query response times ($\le 500\text{ ms}$).
- Generated statement PDFs shall be digitally signed with the financial institution’s X.509 certificate conforming to Adobe CDS (Certified Document Services) standards for legal submission to the Inland Revenue Board of Malaysia (LHDN).

#### FR-WEB-03: Structured Financial & Ledger Data Export
The web portal shall provide data streaming endpoints allowing users to export transaction ledgers across custom date ranges into `.CSV`, `.OFX`, and `.XLSX` formats for import into external personal finance and accounting software.

#### FR-WEB-04: National Addressing Database (NAD) Proxy Management Console
The Laravel web portal shall provide a dedicated management interface for DuitNow proxies:
- Linking/unlinking Malaysian NRIC, Mobile Number, Passport, and Army/Police ID.
- Switching the default receiving account for incoming transfers.
- Viewing active PayNet registration status and NAD reference tokens.

#### FR-WEB-05: Standing Instructions (SI) & Direct Debit Management
- The web portal shall provide tools to establish, modify, pause, and revoke recurring scheduled transfers and standing instructions.
- Users shall be able to view and manage pre-authorized DuitNow AutoDebit and Direct Debit mandates.

#### FR-WEB-06: Term Deposit (eFD / Islamic eGIA) Placement & Rollover Portal
- The web portal shall provide a placement console for conventional e-Fixed Deposits and Islamic Term Deposits (Tawarruq).
- The console shall allow configuration of rollover instructions (Principal + Profit, Principal Only, or Full Credit to Current/Savings Account).

#### FR-WEB-07: Comprehensive Annual Zakat & Shariah Wealth Management
- The web portal shall incorporate a Zakat calculator computing Zakat on Savings and Gold based on Malaysian state Nisab benchmarks.
- The portal shall support direct settlement dispatch to accredited state Zakat agencies (e.g., PPZ-MAIWP, Lembaga Zakat Selangor).

#### FR-WEB-08: Web Fallback Emergency Kill Switch
- The web portal shall provide an emergency account freeze button prominently displayed on the login page and header bar.
- If a user's mobile device is lost, stolen, or compromised, the web portal shall allow the user to trigger an account lockdown using their master password and anti-bot verification without requiring mobile push approval.

### 3.3 Shared Core Functional Requirements (Mobile & Web)

#### FR-SEC-01: Single Device Binding Enforcement
- The system shall bind a user’s authenticated profile to exactly one physical mobile hardware device identifier.
- The public key and device metadata (hardware UUID, OS version, device model) shall be registered in the active database via Laravel's `/api/v1/devices/bind` endpoint.
- Binding a new device shall automatically revoke the active token of any previously registered hardware.

#### FR-SEC-02: Mandatory 12-Hour Cooling-Off Period
Upon successful binding of a new primary mobile device or an upward revision of transaction limits exceeding MYR 1,000, the Laravel backend shall set the user account's cooling-off state in the database (`cooling_off_expires_at = NOW() + INTERVAL '12 hours'`).
During this 12-hour window:
- Outward fund transfers (DuitNow, FPX, JomPAY) initiated from the newly registered device shall be blocked ($limit = \text{MYR } 0$).
- Limit revisions shall remain capped at the pre-existing limit threshold.
- Both the Flutter app and Laravel web portal shall display a prominent, non-dismissible countdown timer detailing the remaining cooling-off duration.

#### FR-SEC-03: Push-Based Soft Token (Secure Approval)
- Web-initiated transfers and high-risk mobile transactions shall deprecate SMS OTP and mandate cryptographic push authorization via the bound Flutter app.
- Challenge nonces shall expire after ninety (90) seconds.
- Approval requires Face ID / Fingerprint verification releasing the hardware-backed private key to sign the challenge nonce.

#### FR-SEC-04: Universal Kill Switch Circuit Breaker
Activation of the Kill Switch executes an atomic database transaction across web and mobile:
- Revokes all active OAuth/Sanctum sessions and personal access tokens (`personal_access_tokens.delete()`).
- Updates customer profile state: `account_status = 'SUSPENDED_COMPROMISED'`.
- Triggers asynchronous webhooks to the Core Banking System (CBS) to block physical/virtual debit cards and freeze outward clearing debits.
- Directs the user to the National Scam Response Centre (NSRC 997) hotline.

#### FR-PAY-01: Instant DuitNow Proxy Transfers
- The system shall execute real-time fund transfers using account numbers or DuitNow Proxy identifiers (Mobile, NRIC, Passport, Army/Police ID).
- The Laravel integration layer shall perform real-time ISO 20022 `pain.001` lookups against PayNet's National Addressing Database (NAD).
- Both channels shall display the recipient's verified legal name prior to final submission.

#### FR-PAY-02: PayNet FPX Merchant Checkout
- The Laravel web platform and Flutter deep-link handler shall support FPX merchant redirects.
- Authorizations mandate verification via the bound Flutter app instead of SMS OTP.

#### FR-ISL-01: Shariah Governance & Islamic Banking Parity
- Accounts governed by Islamic contracts (e.g., Tawarruq, Wadiah, Murabahah) shall strictly display profit rates, hibah disclosures, and financing terms in compliance with the BNM Shariah Governance Framework.
- Direct integration with Lembaga Tabung Haji (TH) for balance inquiries and fund transfers.

---

## 4. External Interface & Database Requirements

### 4.1 Client Hardware & Native Interfaces (Flutter)
- **Biometrics:** Integration via Flutter `local_auth` plugin binding directly to iOS `LAContext` and Android `BiometricPrompt` (`BIOMETRIC_STRONG`).
- **Secure Storage:** Flutter `flutter_secure_storage` storing ephemeral nonces backed by Keychain (iOS) and `EncryptedSharedPreferences` (Android).
- **Anti-Screen Capture:** Flutter native window manager enforcement (`FLAG_SECURE` on Android; dynamic blur overlays on iOS `AppDelegate`).

### 4.2 Web & API Architecture (Laravel)
- **REST & JSON Specifications:** Adherence to JSON:API standards with strict request validation using Laravel FormRequests.
- **Database Portability:** Eloquent ORM queries must avoid vendor-specific SQL functions unless guarded by environment-aware database driver checks (`DB::getDriverName()`).
- **Security Headers:** Enforced via Laravel middleware:
  ```http
  Strict-Transport-Security: max-age=63072000; includeSubDomains; preload
  Content-Security-Policy: default-src 'self'; script-src 'self' 'nonce-...'; object-src 'none'; frame-ancestors 'none';
  X-Frame-Options: DENY
  X-Content-Type-Options: nosniff
  Referrer-Policy: strict-origin-when-cross-origin
  Permissions-Policy: geolocation=(), camera=(), microphone=()
  ```

### 4.3 Database Schema & Persistence Architecture

```text
+-----------------------------------------------------------------------------------------+
|                                  DATABASE SCHEMA (ORM)                                  |
+-----------------------------------------------------------------------------------------+
|  users                                   device_bindings                                |
|  -------------------------------------   ---------------------------------------------  |
|  id: UUID (PK)                           id: UUID (PK)                                  |
|  nric_hash: VARCHAR(64) [UNIQUE]         user_id: UUID (FK -> users.id)                 |
|  full_name: VARCHAR(255)                 device_uuid: VARCHAR(128) [UNIQUE]             |
|  phone_e164: VARCHAR(20)                 public_key_pem: TEXT                           |
|  account_status: VARCHAR(32)             binding_status: VARCHAR(32)                    |
|  cooling_off_expires_at: TIMESTAMPTZ     last_active_at: TIMESTAMPTZ                    |
|  created_at: TIMESTAMPTZ                 created_at: TIMESTAMPTZ                        |
+-----------------------------------------------------------------------------------------+
                                    │
                                    ▼
+-----------------------------------------------------------------------------------------+
|  ledger_accounts                         transactions                                   |
|  -------------------------------------   ---------------------------------------------  |
|  id: UUID (PK)                           id: UUID (PK)                                  |
|  account_number: VARCHAR(20) [UNIQUE]    account_id: UUID (FK -> ledger_accounts.id)    |
|  user_id: UUID (FK -> users.id)          type: VARCHAR(32) (DUITNOW_TRANSFER, JOMPAY...) |
|  currency: VARCHAR(3) DEFAULT 'MYR'      amount: NUMERIC(15,2)                          |
|  available_balance: NUMERIC(15,2)        recipient_proxy: VARCHAR(64)                   |
|  ledger_balance: NUMERIC(15,2)           paynet_rrn: VARCHAR(64) [INDEX]                |
|  contract_type: VARCHAR(32)              status: VARCHAR(32)                            |
|  updated_at: TIMESTAMPTZ                 created_at: TIMESTAMPTZ                        |
+-----------------------------------------------------------------------------------------+
                                    │
                                    ▼
+-----------------------------------------------------------------------------------------+
|  audit_logs (Immutable Append-Only)                                                     |
|  -------------------------------------------------------------------------------------  |
|  id: BIGSERIAL / INTEGER (PK)                                                           |
|  event_type: VARCHAR(64) (KILL_SWITCH, DEVICE_BOUND, HIGH_VALUE_TRANSFER...)            |
|  actor_id: UUID (FK -> users.id)                                                        |
|  ip_address: VARCHAR(45)                                                                |
|  user_agent: TEXT                                                                       |
|  payload_hash: VARCHAR(64)                                                              |
|  created_at: TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP                                      |
+-----------------------------------------------------------------------------------------+
```

#### Environment Compatibility Specifications:
- **UUID Handling:** Handled via Laravel’s `$table->uuid('id')->primary()`, which generates standard RFC 4122 UUIDs compatible natively with PostgreSQL (`uuid` type) and SQLite (`varchar(36)`).
- **Production Partitioning (PostgreSQL):** Production database migrations utilize conditional PostgreSQL raw DDL to set up monthly range partitions on the `transactions` table. For local SQLite development, standard non-partitioned indexed tables are provisioned.
- **Audit Log Immutability:** In production, PostgreSQL triggers block `UPDATE` and `DELETE` queries on `audit_logs`. In local development/testing, Eloquent model policies and read-only event hooks emulate immutability.

---

## 5. Non-Functional Requirements (NFRs)

### 5.1 Security, Cryptography & BNM RMiT Directives

#### NFR-SEC-01: End-to-End Transport Security & Certificate Pinning
- All communications across web and mobile channels shall strictly mandate TLS 1.3 encryption with forward secrecy cipher suites (`TLS_AES_256_GCM_SHA384`, `TLS_CHACHA20_POLY1305_SHA256`).
- The Flutter client shall enforce dynamic Public Key Pinning (HPKP / SHA-256 SPKI hashes) within its network layer, backed by automated fallback domain validation. Connections exhibiting certificate mismatch or proxy-inspection certificates (e.g., Charles, Burp Suite) shall abort immediately.
- Cleartext HTTP ($port = 80$) traffic shall be disabled across all perimeter ingress gateways.

#### NFR-SEC-02: PII Data Protection at Rest (PDPA 2010)
- Personal Identifiable Information (Malaysian NRIC, mobile numbers, home addresses) stored in PostgreSQL or SQLite shall be encrypted at the application tier using AES-256-GCM before writing to the persistence layer.
- The application shall compute one-way salted deterministic blind hashes ($\text{HMAC-SHA256}(\text{value}, \text{APP\_KEY})$) to support indexing and database lookups without decrypting entire columnar spaces.
- Application encryption keys shall be managed via a dedicated Key Management Service (KMS) or Hardware Security Module (HSM) conforming to FIPS 140-2 Level 3 standards, with automatic annual key rotation.

#### NFR-SEC-03: Mobile Runtime Application Self-Protection (RASP)
The Flutter application shall perform dynamic runtime integrity checks at boot and before every cryptographic signing operation:
- Detection of root (SuperSU, Magisk, KernelSU) and jailbreak binaries (`/bin/sh`, Cydia, Sileo).
- Detection of dynamic instrumentation tools (Frida, Xposed framework, Substrate).
- Detection of active debuggers (LLDB, GDB) and Android emulator/simulator execution environments.
- Upon detection of any compromise indicator, the client shall zero out sensitive memory registers, purge cached credentials via `flutter_secure_storage.deleteAll()`, and terminate the process within $\le 500\text{ ms}$.

#### NFR-SEC-04: Web Ingress Protection & OWASP Top 10 Mitigation
- The Laravel application tier shall be deployed behind a certified Web Application Firewall (WAF) providing real-time anti-DDoS mitigation and Layer 7 anomaly detection.
- The web portal shall enforce strict security headers:
  ```http
  Strict-Transport-Security: max-age=63072000; includeSubDomains; preload
  Content-Security-Policy: default-src 'self'; script-src 'self' 'nonce-...'; object-src 'none'; frame-ancestors 'none';
  X-Frame-Options: DENY
  X-Content-Type-Options: nosniff
  Referrer-Policy: strict-origin-when-cross-origin
  Permissions-Policy: geolocation=(), camera=(), microphone=()
  ```
- All user input shall be sanitized against Cross-Site Scripting (XSS) and SQL injection using Eloquent parameterized bindings and Laravel HTML entity purification.

#### NFR-SEC-05: Session Lifecycles & Token Security
- Web session cookies shall be marked with flags: `HttpOnly`, `Secure`, `SameSite=Strict`.
- Mobile authentication tokens (Sanctum / JWT) shall feature a strict Time-To-Live (TTL) of fifteen (15) minutes, refreshing automatically through hardware enclave signature verification.
- Sessions shall time out automatically upon inactivity:
  - **Mobile App:** Inactive foreground timeout $= 3\text{ minutes}$; background suspension timeout $= 2\text{ minutes}$.
  - **Web Portal:** Inactive session timeout $= 5\text{ minutes}$.

### 5.2 Performance, Throughput & Scalability

#### NFR-PRF-01: Client Response Times & Perceived Latency
Under normal operational loads (50th to 90th percentile), the system shall meet the following response latency standards:
- **Mobile Cold Start:** The Flutter app shall render the authenticated dashboard or login interface in $\le 2.0\text{ seconds}$ on mid-tier hardware (e.g., octa-core ARM64 with 4GB RAM).
- **Mobile Warm/Resume Start:** Render time $\le 500\text{ ms}$.
- **Web Page Load Time:** Web portal First Contentful Paint (FCP) $\le 1.2\text{ seconds}$; Largest Contentful Paint (LCP) $\le 2.5\text{ seconds}$ over standard 4G broadband connections.
- **Balance Inquiry & Account Activity API:** $\le 200\text{ ms}$ response latency.

#### NFR-PRF-02: End-to-End Payment Processing Latency
- Outward instant payment operations (DuitNow Proxy transfers, DuitNow QR POS clearances) shall achieve complete end-to-end clearing (client request $\to$ Laravel API $\to$ PayNet Switch $\to$ ledger settlement $\to$ client receipt) within $\le 2.5\text{ seconds}$ for $95\%$ of transactions.
- PayNet webhook ingestion and confirmation callbacks shall process in $\le 150\text{ ms}$ under sustained loads.

#### NFR-PRF-03: Concurrency, Throughput & Scalability
- The production Laravel Octane and PostgreSQL persistence cluster shall sustain a baseline throughput of $\ge 2,500$ concurrent transactions per second (TPS) during normal operation, with peak surge capability up to $10,000\text{ TPS}$ during festive or month-end clearing cycles.
- PgBouncer connection pooling shall maintain up to $15,000$ active client connections with zero database thread exhaustion or memory leakage.

#### NFR-PRF-04: Local Development & CI Pipeline Performance (SQLite 3)
- The SQLite 3 local development and test setup shall execute test suites in-memory (`:memory:`) at a rate $\ge 50$ feature/unit tests per second.
- A full regression test run of $1,000$ test cases shall complete in $\le 30\text{ seconds}$ on standard developer workstations (Apple Silicon M-series or Intel/AMD 8-core CPU with 16GB RAM).

### 5.3 Availability, Reliability & Disaster Recovery

#### NFR-AVL-01: Service Uptime & High Availability
- The retail banking platform shall deliver an overall system availability of $\ge 99.98\%$ on a $24\times7\times365$ basis, excluding pre-scheduled Bank Negara Malaysia maintenance windows.
- Maximum unscheduled downtime shall not exceed $1.75\text{ hours}$ across an entire calendar year.

#### NFR-AVL-02: Recovery Objectives (RPO & RTO)
- **Recovery Point Objective (RPO):** $RPO = 0$ (zero data loss) for all committed financial ledger transactions. Synchronous streaming replication across physical availability zones shall guarantee ledger persistence prior to client transaction acknowledgement.
- **Recovery Time Objective (RTO):** $RTO \le 60\text{ seconds}$ in the event of primary database cluster node failure, with automated failover managed via Patroni and virtual IP switching. Complete multi-region data center failover shall execute within $\le 15\text{ minutes}$.

#### NFR-AVL-03: Fault Tolerance & Circuit Breaking
- The Laravel integration tier shall implement circuit breakers (via Redis token counters) for external dependencies (PayNet, JPN MyKad eKYC, APNs/FCM).
- If PayNet switch latency exceeds $5.0\text{ seconds}$ for more than five (5) consecutive requests, the gateway shall automatically trip the circuit breaker, gracefully returning descriptive errors (`ERR_PAYNET_UNAVAILABLE_RETRY_LATER`) while protecting core banking queues from worker exhaustion.

### 5.4 Persistence Tier & Concurrency Architecture

#### NFR-DAT-01: Concurrency Control & Double-Spend Elimination
All ledger debit/credit postings shall execute inside serialized database transactions utilizing pessimistic locking:
```sql
SELECT id, available_balance, ledger_balance
FROM ledger_accounts
WHERE id = :accountId
FOR UPDATE;
```
The system shall eliminate race conditions and double-spending across concurrent mobile and web requests. The database engine shall reject transactions if conflicting write locks cannot be acquired within a $3.0\text{ second}$ timeout threshold.

#### NFR-DAT-02: Partitioning & Query Optimization (PostgreSQL 16)
The production `transactions` and `audit_logs` tables shall implement range partitioning by month on `created_at`. Ledger history queries filtering across custom date ranges shall leverage partition pruning, ensuring statement generation queries across $10,000,000+$ historical records return in $\le 500\text{ ms}$.

#### NFR-DAT-03: Audit Trail Non-Repudiation & Immutability
- In production PostgreSQL, the `audit_logs` table shall be protected by row-level database triggers that raise fatal exceptions on any attempt to execute `UPDATE` or `DELETE` statements.
- Each audit log record shall calculate a cryptographic linkage hash ($\text{SHA-256}(\text{id} + \text{payload} + \text{previous\_hash})$), forming a verifiable tamper-evident hash chain.

### 5.5 Compliance, Governance & Auditability

#### NFR-REG-01: BNM RMiT Regulatory Adherence
The platform shall comply with all standards prescribed in the BNM Policy Document on Risk Management in Technology (RMiT), including:
- **Standard 10.49:** Mandatory restriction of mobile retail banking access to a single hardware-bound identity device.
- **Standard 10.50:** Compulsory out-of-band multi-factor authentication for web portal transactions.
- **Standard 10.51:** Complete deprecation of SMS OTP for transaction verification in favor of public-key soft tokens.
- **5 Mandatory Anti-Scam Measures:** Compulsory 12-hour cooling-off periods, universal Kill Switch, dedicated 24/7 scam reporting links to NSRC 997.

#### NFR-REG-02: Statutory Record Retention (FSA 2013 & IFSA 2013)
- Financial transaction logs, digitally signed e-statements, customer authorization nonces, and account ledgers shall be retained in active or warm immutable storage for a minimum of eighty-four (84) months (7 statutory years).
- Storage systems shall enforce Write-Once-Read-Many (WORM) storage retention policies to prevent premature deletion or alteration during legal discovery proceedings.

#### NFR-REG-03: Islamic Banking Shariah Governance Framework
- Islamic banking facilities (e.g., Tawarruq, Wadiah Yad Dhamanah, Murabahah) shall maintain segregated ledger balances and chart of accounts within the persistence tier to prevent co-mingling with conventional funds.
- Late payment charges (Ta'widh and Gharamah) and profit accrual calculation routines shall be governed by deterministic algorithms certified by the bank's Shariah Committee.

### 5.6 Usability, Accessibility & Localization

#### NFR-USE-01: Accessibility Standards (WCAG 2.1 Level AA)
The Laravel web portal and Flutter mobile application shall comply with the Web Content Accessibility Guidelines (WCAG) 2.1 Level AA:
- Color contrast ratios for text and interface elements shall maintain a minimum of $4.5:1$.
- Full keyboard navigation and assistive technology compatibility (VoiceOver on iOS, TalkBack on Android, screen readers on desktop browsers).
- Dynamic text scaling support up to $200\%$ without clipping or loss of functionality.

#### NFR-USE-02: National Localization & Dual-Language Parity
- The system shall offer complete, real-time linguistic parity across Bahasa Melayu (National Language) and English.
- Currency formats, decimal indicators, and date-time strings shall adhere to Malaysian standards:
  - **Currency format:** `RM 1,234.56` or `MYR 1,234.56`.
  - **Date format:** `DD/MM/YYYY` (e.g., `31/08/2026`).
  - **Time format:** 12-hour format with AM/PM indicators or 24-hour standard (`14:30`).

### 5.7 Maintainability, Portability & CI/CD Operations

#### NFR-MNT-01: Automated Test Coverage & Code Quality
- The mobile Flutter codebase shall enforce a minimum of $90\%$ unit and state (BLoC) test coverage, with zero static analysis warnings under `flutter analyze --fatal-infos`.
- The Laravel backend codebase shall achieve $\ge 85\%$ test coverage across all domain services, FormRequests, and controllers, verified via Pest PHP and PHPStan at Level 8.

#### NFR-MNT-02: Zero-Downtime Deployment & CI/CD Pipeline
- The production architecture shall support zero-downtime blue/green or rolling container updates orchestrated via Kubernetes, ensuring existing user sessions and PayNet transactions are not severed during application updates.
- Database schema migrations shall be strictly backwards-compatible (expand-and-contract pattern), prohibiting disruptive column drops or type mutations in production without prior phased deprecation.
