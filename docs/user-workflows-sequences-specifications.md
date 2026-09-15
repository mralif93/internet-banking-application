# User Workflows & Sequence Specifications
## Malaysian Personal Retail Digital Banking Ecosystem

- **Target Stack:** Flutter Mobile (iOS/Android), Laravel 11+ (Web Portal & Core Gateway), PostgreSQL 16 (Production) / SQLite 3 (Local & CI)
- **Regulatory Directives:** Bank Negara Malaysia (BNM) RMiT, PayNet Operational Rules, FSA 2013, PDPA 2010
- **Document Version:** 2.0.0

---

## 1. Architectural Channel Separation Overview

The digital banking ecosystem enforces a strict separation of operational responsibilities across two client channels:

```text
|                                       CLIENT CHANNELS                                         |
|                                                                                               |
|  [ Flutter Mobile Application ]                             [ Laravel Web Portal ]            |
|  - Cryptographic Identity Token (Enclave Keys)              - Bulk Settlements & JomPAY       |
|  - Biometric eKYC & Liveness Capture                        - Multi-Year Certified Statements |
|  - DuitNow QR Camera Scanner / Presenter                    - Financial Management Console    |
|  - Out-of-Band (OOB) Challenge Signer                       - Emergency Web Kill Switch       |
|  - In-App Emergency Kill Switch & NSRC Link                 - DuitNow NAD Proxy Manager       |
+-----------------------------------------------------------------------------------------------+
                                 │                                          │
                                 ▼ (mTLS / API Gateway)                     ▼ (Session / HTTPS)
+-----------------------------------------------------------------------------------------------+
|                                LARAVEL APPLICATION GATEWAY                                    |
|             (Authentication, Orchestration, Cooling-Off Engine, Ledger Integrity)             |
+-----------------------------------------------------------------------------------------------+
```

---

## 2. Part I: Mobile Application Workflows (Flutter Client)

### MWF-01: Digital Onboarding, eKYC & Hardware Device Binding

Enforces BNM’s policy of exactly one bound mobile device per retail customer profile, hardware-backed key generation, and entry into the 12-hour cooling-off window.

#### Sequence Diagram

```text
Customer               Flutter Mobile Client                Laravel API Gateway             PostgreSQL / SQLite
   │                            │                                    │                               │
   │── 1. Enter NRIC & Pass ───>│                                    │                               │
   │                            │── 2. POST /api/v1/auth/login ─────>│                               │
   │                            │      (nric_hash, pwd)              │── 3. Find By Blind Hash ─────>│
   │                            │                                    │<── Return User Record ────────│
   │                            │<── 4. 200 OK (eKYC Required) ──────│                               │
   │                                                                 │                               │
   │── 5. Scan MyKad & Face ───>│                                    │                               │
   │    (Native Camera Stream)  │── 6. POST /api/v1/ekyc/verify ────>│── 7. Verify JPN / Liveness ──>│
   │                            │<── 8. eKYC Approved ───────────────│                               │
   │                                                                 │                               │
   │── 9. Biometric Prompt ────>│                                    │                               │
   │    (Face ID / Fingerprint) │── 10. Generate EC P-256 Keypair ───│                               │
   │                            │       (iOS Enclave / Android KS)   │                               │
   │                            │                                    │                               │
   │                            │── 11. POST /api/v1/devices/bind ──>│                               │
   │                            │       (UUID, PubKey, Device Model) │── 12. Atomic DB Transaction: >│
   │                            │                                    │   a. Revoke old device records│
   │                            │                                    │   b. Insert new device_binding│
   │                            │                                    │   c. cooling_off_expires_at = │
   │                            │                                    │      NOW() + INTERVAL '12h'   │
   │                            │                                    │   d. Log to audit_logs        │
   │                            │                                    │<── 13. Transaction Commit ────│
   │                            │<── 14. 201 Created (Cooling-Off) ──│                               │
   │<── 15. Render Home Screen ─│                                    │                               │
   │    with 12h Countdown      │                                    │                               │
```

#### Step-by-Step Execution

1. **Identifier Submission:** Customer inputs their 12-digit MyKad NRIC and master password.
2. **Deterministic Lookup:** Flutter computes an HMAC-SHA256 hash using the shared application salt (`nric_hash`) and transmits it over TLS 1.3. Laravel locates the user record via index without decrypting table data.
3. **Biometric eKYC Verification:** The Flutter app opens the device camera, captures the physical MyKad, verifies optical security features, and performs 3D facial liveness verification against registered demographic records.
4. **Hardware Keypair Provisioning:**
   - **iOS:** Generated in the Secure Enclave using `kSecAttrKeyTypeECSECPrimeRandom` (256-bit elliptic curve).
   - **Android:** Generated in Android Keystore with `KeyProperties.PURPOSE_SIGN`, requiring `BIOMETRIC_STRONG` authentication.
   - Private keys are marked strictly non-exportable and inaccessible to the OS filesystem.
5. **Atomic Device Binding:** Laravel starts a database transaction:
   - Existing `device_bindings` for the user are marked `REVOKED_SUPERSEDED`.
   - The new hardware public key, hardware UUID, OS version, and app version are stored in `device_bindings`.
   - `users.cooling_off_expires_at` is set to $\text{NOW}() + 12\text{ hours}$.
   - An append-only record is committed to `audit_logs`.
6. **Client Restriction:** The Flutter UI unlocks read-only access (balances, historical statements) while presenting a persistent 12-hour cooling-off banner. All outward fund transfers return HTTP 403 Forbidden (`ERR_COOLING_OFF_ACTIVE`).

### MWF-02: DuitNow QR Point-of-Sale (POS) & Cross-Border Scan-and-Pay

Handles physical merchant checkout via the Malaysian National QR Standard (EMVCo) and real-time bilateral clearing with foreign switches (PromptPay Thailand, NETS Singapore, QRIS Indonesia).

#### Sequence Diagram

```text
Customer             Merchant Terminal            Flutter Mobile Client          Laravel Gateway           PayNet Switch
   │                         │                              │                           │                        │
   │                         │── 1. Present EMVCo QR ──────>│                           │                        │
   │                         │                              │── 2. Parse & Decode ─────>│                        │
   │                         │                              │    (POST /api/qr/decode)  │                        │
   │                         │                              │<── 3. Merchant Profile ───│                        │
   │                         │                              │       + Live FX Rates     │                        │
   │── 4. Confirm / Enter ──>│                              │                           │                        │
   │      Amount (e.g., THB) │                              │                           │                        │
   │── 5. Biometric Sensor ─>│                              │                           │                        │
   │      (Sign Tx Nonce)    │                              │── 6. POST /api/qr/pay ───>│                        │
   │                         │                              │    (Payload, Sign, Nonce) │── 7. FOR UPDATE Lock ──>│
   │                         │                              │                           │   (Check Balance)      │
   │                         │                              │                           │── 8. ISO 20022 pacs.008│
   │                         │                              │                           │<─ 9. pacs.002 (Accept)─│
   │                         │                              │                           │── 10. Ledger Debit/Cred│
   │                         │<─────────────────────────────┼───────────────────────────│── 11. Instant Notify ──>│
   │                         │   Terminal Audio Prompt      │                           │                        │
   │<── 12. Render Receipt ──┼──────────────────────────────│<── 13. 200 OK (Success) ──│                        │
```

#### Step-by-Step Execution

1. **Camera Feed Scanning:** The Flutter camera scanner decodes the EMVCo string and extracts Tag 26 (Merchant ID), Tag 53 (Currency Code), and Tag 54 (Transaction Amount).
2. **Corridor Resolution:**
   - **Domestic transactions** (Tag 53 = 458 / MYR) resolve merchant metadata directly.
   - **Cross-border transactions** (e.g., Tag 53 = 764 / THB) trigger a real-time wholesale treasury FX conversion request, rendering the exact foreign currency total alongside the final MYR debit amount.
3. **Enclave Signing & Concurrency Protection:**
   - Customer confirms via `local_auth` biometrics. The secure enclave signs a transaction hash consisting of `nonce + amount + merchant_id`.
   - Laravel initiates an isolated database transaction with row-level locking:
     ```sql
     SELECT id, available_balance FROM ledger_accounts WHERE id = :accountId FOR UPDATE;
     ```
   - Funds are verified against the balance and the daily spending threshold.
4. **PayNet Clearing & Ledger Settlement:**
   - Laravel dispatches an ISO 20022 `pacs.008.001.08` payload to PayNet.
   - Upon receiving `pacs.002.001.10` settlement confirmation, Laravel posts balanced entries to `journal_entries` (debiting the customer account and crediting the PayNet clearing settlement account).
   - The transaction commits, releasing the lock, and the Flutter app displays the completed receipt screen.

### MWF-03: Mobile Out-of-Band (OOB) Push Token Challenge Authorization

The Flutter mobile application acts as the dedicated cryptographic approval token for transactions initiated on external channels (e.g., Laravel web portal, 3rd-party FPX merchant gateways).

#### Sequence Diagram

```text
Customer           Flutter Mobile Client            APNs / FCM Push Gateway         Laravel Gateway
   │                         │                                 │                           │
   │                         │                                 │<── 1. Dispatch High-Pri ──│
   │                         │                                 │       Data Message        │
   │                         │<── 2. Receive Push Trigger ─────│       (Nonce + Summary)   │
   │                         │                                                             │
   │                         │── 3. Wake Background Service & Fetch /challenges/active ───>│
   │                         │<── 4. Return Full Payload (Recipient, Amount, IP, Web Sess)─│
   │                         │                                                             │
   │<── 5. Display Security ─│                                                             │
   │       Approval Dialog   │                                                             │
   │── 6. Tap "Approve" ────>│                                                             │
   │── 7. Biometric Auth ───>│                                                             │
   │                         │── 8. Secure Enclave Signs Challenge Nonce                   │
   │                         │                                                             │
   │                         │── 9. POST /api/v1/push/authorize ──────────────────────────>│
   │                         │      (challenge_nonce, signature_payload, device_uuid)      │── 10. Verify ECDSA Sign
   │                         │                                                             │   against DB PubKey
   │                         │<── 11. 200 OK (Challenge Consumed) ─────────────────────────│── 12. Release Web Lock
   │<── 12. Render Done ─────│                                                             │
```

#### Step-by-Step Execution

1. **Push Delivery:** The mobile device receives a data push via Apple Push Notification service (APNs) or Firebase Cloud Messaging (FCM) containing the pending authorization UUID.
2. **Interactive Security Modal:** Flutter wakes up and displays a full-screen authorization prompt showing the transfer amount, recipient name, payment rail, timestamp, and originating web IP address.
3. **Biometric Signing:** The user taps "Approve" and authenticates using Face ID or fingerprint. The hardware enclave signs the challenge nonce.
4. **Signature Verification:** Flutter dispatches the base64-encoded signature to `/api/v1/push/authorize`. Laravel validates the signature against `device_bindings.public_key_pem`.
5. **State Transition:** The `push_authorizations` status moves from `PENDING` to `APPROVED`, allowing the originating channel to complete processing.

### MWF-04: In-App Emergency Kill Switch Activation

Provides immediate self-service account freezing when a customer suspects fraud, phishing, or credential loss directly from the mobile app.

#### Step-by-Step Execution

1. **Trigger:** The user taps the red "Kill Switch" button pinned to the mobile navigation bar and confirms the warning dialog.
2. **API Dispatch:** Flutter calls `/api/v1/emergency/freeze` sending the active bearer token.
3. **Local Cache Cleared:**
   - Flutter invokes `flutter_secure_storage.deleteAll()` to wipe session tokens, cached profile data, and ephemeral cryptographic keys.
   - Native window security (`FLAG_SECURE`) remains active to block screenshots.
4. **UI Lockdown:** The application transitions into an un-dismissible lockout state providing a direct one-tap call button to the National Scam Response Centre (NSRC 997) and the bank’s fraud center.

---

## 3. Part II: Web Portal Workflows (Laravel / Inertia.js Client)

### WWF-01: Dual-Factor Web Authentication & Out-of-Band Push Handshake

Protects internet banking logins by replacing legacy SMS OTPs with mandatory out-of-band cryptographic mobile verification.

#### Sequence Diagram

```text
Customer               Browser (Web Portal)               Laravel Backend             Bound Mobile Device
   │                             │                               │                             │
   │── 1. Enter NRIC & Pass ────>│                               │                             │
   │                             │── 2. POST /web/login ────────>│                             │
   │                             │      (nric_hash, password)    │── 3. Validate Credentials   │
   │                             │                               │── 4. Generate Auth Nonce    │
   │                             │                               │── 5. Push Notification ────>│
   │                             │<── 6. 200 OK (Render Modal ───│                             │
   │                             │       "Check Your Phone")     │                             │
   │<── 7. Display 90s Spinner ──│                               │                             │
   │      + Laravel Echo Listener│                               │                             │
   │                             │                               │                             │── 8. User Approves &
   │                             │                               │<── 9. Signed Token Returned─│      Signs with Enclave
   │                             │                               │── 10. Verify ECDSA PubKey   │
   │                             │                               │── 11. Create Sanctum Cookie │
   │                             │<── 12. WebSocket Broadcast ───│       (HttpOnly, Secure)    │
   │                             │        ("AUTH_SUCCESS")       │                             │
   │<── 13. Redirect to Dashboard│                               │                             │
```

#### Step-by-Step Execution

1. **Credential Input:** The user submits their MyKad NRIC, password, and solves an anti-bot CAPTCHA on the web portal.
2. **Pending Session State:** Laravel authenticates credentials, identifies the user's active device from `device_bindings`, and generates a 90-second cryptographic challenge nonce in `push_authorizations`.
3. **Out-of-Band Challenge Dispatch:** Laravel sends a high-priority push message to the user's bound mobile phone.
4. **WebSocket Listener:** The web browser renders a waiting modal and establishes a private WebSocket channel connection (via Laravel Echo / Pusher) listening for `PushAuthApproved`.
5. **Verification & Session Upgrading:** Once the user signs the nonce on their mobile device, Laravel updates the challenge status, creates an authenticated web session cookie (`HttpOnly`, `SameSite=Strict`), and broadcasts the success event over the WebSocket channel. The browser automatically navigates to the account dashboard.

### WWF-02: Multi-Biller JomPAY Batch Settlement Workflow

Designed for larger desktop displays, enabling users to stage and pay up to 20 utility, council, and institutional bills in a single transaction batch.

#### Sequence Diagram

```text
Customer                Laravel Web Portal (Inertia)           Laravel Backend               PayNet JomPAY Rail
   │                                  │                               │                              │
   │── 1. Input Biller Codes & Refs ─>│                               │                              │
   │      (TNB, Syabas, Unifi)        │── 2. POST /jompay/validate ──>│                              │
   │                                  │      (Batch Payload)          │── 3. Validate Biller Codes ──>│
   │                                  │                               │<─ 4. Billers Validated ──────│
   │                                  │<── 5. Return Validated List ──│                              │
   │<── 6. Review Aggregate Total ───│                               │                              │
   │      (e.g., MYR 840.50)          │                               │                              │
   │── 7. Click "Pay All" ───────────>│                               │                              │
   │                                  │── 8. POST /jompay/batch-pay ─>│                              │
   │                                  │                               │── 9. Check 12h Cooling-Off   │
   │                                  │                               │── 10. Gen Batch OOB Nonce    │
   │<── 11. Prompt Mobile Approval ───│<── 12. Return Challenge ID ───│                              │
   │                                  │                               │                              │
   │   [ User confirms batch on bound mobile phone via Biometric Enclave Signature (MWF-03) ]         │
   │                                  │                               │                              │
   │                                  │<── 13. Echo Push Approved ────│── 14. DB Transaction: ───────│
   │                                  │                               │    a. FOR UPDATE Lock Ledger │
   │                                  │                               │    b. Debit Customer Account │
   │                                  │                               │    c. Dispatch JomPAY Jobs ──│
   │                                  │                               │    d. Write Journal Entries  │
   │<── 15. Render Consolidated ──────│<── 16. Batch Complete HTTP 200│                              │
   │        PDF Batch Receipts        │                               │                              │
```

#### Step-by-Step Execution

1. **Batch Preparation:** The user inputs multiple JomPAY Biller Codes, Ref-1 account numbers, optional Ref-2 values, and individual transfer amounts into the batch entry table.
2. **Biller Validation:** Laravel queries the local `jompay_billers` table to confirm biller status and validates format rules for Ref-1/Ref-2 values.
3. **Aggregate Review & Cooling-Off Check:**
   - The web interface displays the calculated batch total.
   - Laravel verifies that the customer is not in a cooling-off period (`cooling_off_expires_at` is null or in the past) and confirms the batch total does not exceed the daily transfer limit.
4. **Single OOB Push Authorization:** Laravel aggregates the batch items into a single challenge summary (e.g., *"Approve batch payment for 3 bills totaling RM 840.50"*), sending a single push challenge to the mobile device instead of requiring separate prompts for each bill.
5. **Execution & Clearing:**
   - Upon receiving mobile signature approval, Laravel opens a database transaction with a row lock on `ledger_accounts`.
   - The full batch amount is debited from the customer’s balance.
   - Balanced debit and credit rows are committed to `journal_entries`.
   - Laravel Horizon queues asynchronous outgoing JomPAY clearing jobs to PayNet.
   - The web portal provides downloadable, digitally signed individual receipts and an aggregate statement.

### WWF-03: Certified e-Statement Retrieval & Regulatory Tax Archives

Provides certified, tamper-evident financial statement downloads spanning an 84-month (7-year) retention window, structured for official tax (LHDN) and loan processing.

#### Step-by-Step Execution

1. **Archive Query:** The user navigates to the Statements portal, selecting an account, file format (.PDF, .CSV, .OFX), and date range.
2. **Partition Pruning:** In production PostgreSQL, Laravel routes the query to the relevant monthly range partition of transactions based on `created_at`:
   ```sql
   SELECT * FROM transactions
   WHERE source_account_id = :accountId
     AND created_at BETWEEN '2023-01-01' AND '2023-12-31';
   ```
   Range partitioning prevents full table scans on multi-gigabyte transaction histories.
3. **Cryptographic Signing (PDF):**
   - Laravel compiles the document using Blade templates.
   - The resulting PDF is signed using the bank’s X.509 digital certificate stored in a Hardware Security Module (HSM), generating an Adobe CDS-compliant digital signature verifying document authenticity.
4. **Audit Logging:** An entry is added to `audit_logs` capturing the customer ID, IP address, user-agent, statement period, and timestamp. The file streams directly to the browser with `Content-Disposition: attachment`.

### WWF-04: Web-Initiated Emergency Kill Switch

Allows customers to immediately lock down their banking profile from a desktop browser if their primary mobile device is lost, stolen, or compromised by malware.

#### Sequence Diagram

```text
Customer                 Laravel Web Portal                  Laravel Backend                Core DB & CBS
   │                              │                                 │                             │
   │── 1. Click "KILL SWITCH" ───>│                                 │                             │
   │    (Header Banner)           │                                 │                             │
   │<── 2. Render Destructive ────│                                 │                             │
   │       Warning Modal          │                                 │                             │
   │── 3. Confirm Password & OTP ─>│                                 │                             │
   │                              │── 4. POST /web/emergency-freeze>│                             │
   │                              │      (CSRF + Master Password)   │── 5. Atomic DB Transaction:─│
   │                              │                                 │   a. Lock user row          │
   │                              │                                 │   b. status = SUSPENDED     │
   │                              │                                 │   c. Delete all tokens      │
   │                              │                                 │   d. Invalidate all devices │
   │                              │                                 │   e. Insert audit_logs      │
   │                              │                                 │<─ 6. DB Commit Confirmed ───│
   │                              │                                 │                             │
   │                              │                                 │── 7. Async Dispatches ─────>│
   │                              │                                 │   - Block Cards in CBS      │
   │                              │                                 │   - Halt Outward Clearing   │
   │                              │                                 │                             │
   │                              │<── 8. 200 OK (Session Destroyed)│                             │
   │<── 9. Hard Redirect to ──────│                                 │                             │
   │       Emergency Hotline Page │                                 │                             │
```

#### Step-by-Step Execution

1. **Activation:** The customer clicks the red emergency banner located in the web portal navigation header.
2. **Re-Authentication:** The user confirms their master password and passes an automated CAPTCHA check. (Because the phone may be lost or stolen, this web fallback does not require mobile push authorization).
3. **Atomic Execution:** Laravel executes an immediate database transaction:
   - Sets `users.account_status = 'SUSPENDED_COMPROMISED'`.
   - Deletes all entries in `personal_access_tokens` across web and mobile.
   - Updates all associated `device_bindings` records to `BLOCKED_TAMPERED`.
   - Destroys the current web session and invalidates the session cookie.
4. **Downstream Freezes:** Laravel Horizon dispatches prioritized jobs to the Core Banking System (CBS) and card management switch (Visa/Mastercard) to block all physical and virtual debit cards.
5. **Hotline Redirection:** The web browser redirects to a public static confirmation page displaying incident reference details, a link to the National Scam Response Centre (NSRC 997), and the bank’s 24/7 fraud hotline.

---

## 4. Cross-Channel Interaction & Traceability Matrix

| Flow ID | Channel | Interaction Type | Primary DB Tables | BNM / PayNet Regulatory Standard |
| :--- | :--- | :--- | :--- | :--- |
| **MWF-01** | Mobile (Flutter) | eKYC + Enclave Key Registration | `users`, `device_bindings`, `audit_logs` | BNM RMiT s10.49 (Single Device Binding) & 12h Cooling-Off Policy |
| **MWF-02** | Mobile (Flutter) | EMVCo Scanner + QR Clearing | `ledger_accounts`, `transactions`, `journal_entries` | PayNet DuitNow QR Specs & ISO 20022 Clearing Guidelines |
| **MWF-03** | Mobile (Flutter) | Native Biometric Signature | `push_authorizations`, `device_bindings` | BNM RMiT s10.51 (Replacement of SMS OTP with Push Token) |
| **MWF-04** | Mobile (Flutter) | Emergency Account Lockdown | `users`, `device_bindings`, `audit_logs` | BNM Mandatory 5 Key Measures to Combat Financial Scams |
| **WWF-01** | Web (Laravel) | Dual-Factor Login Handshake | `users`, `push_authorizations`, `sessions` | BNM RMiT s10.50 (Multi-Factor Authentication for Web Channels) |
| **WWF-02** | Web (Laravel) | Batch Bill Processing | `ledger_accounts`, `transactions`, `jompay_billers` | PayNet JomPAY Operational Rules |
| **WWF-03** | Web (Laravel) | Certified Tax/e-Statements | `transactions` (Partitioned), `audit_logs` | FSA 2013 Statutory Record Retention (7 Years / 84 Months) |
| **WWF-04** | Web (Laravel) | Self-Service Account Freeze | `users`, `device_bindings`, `personal_access_tokens` | BNM 5 Key Scam Measures (Kill Switch accessible across all channels) |
