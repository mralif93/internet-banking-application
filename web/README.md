# BankFlow MY — Laravel Web Portal & Application Gateway

<p align="center">
  <a href="https://mralif93.github.io/internet-banking-application/">
    <img src="https://img.shields.io/badge/Live_Showcase-GitHub_Pages-6366f1?style=for-the-badge&logo=github&logoColor=white" alt="Live Showcase on GitHub Pages">
  </a>
  <img src="https://img.shields.io/badge/Laravel-11%2B%20%2F%2012%2B-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/Tailwind_CSS-v4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Inertia.js-Vue%20%2F%20Blade-9553E9?style=for-the-badge&logo=inertia&logoColor=white" alt="Inertia.js">
  <img src="https://img.shields.io/badge/Sanctum-Asymmetric%20Auth-F56565?style=for-the-badge&logo=laravel&logoColor=white" alt="Sanctum">
  <img src="https://img.shields.io/badge/PayNet-JomPAY%20%7C%20DuitNow-blue?style=for-the-badge&logo=contactlesspayment" alt="PayNet Gateway">
</p>

---

## 📋 Module Overview & Gateway Responsibilities

The `web/` directory contains the **Laravel Application Gateway & Desktop Internet Banking Web Portal**. It serves as the core orchestration engine, financial ledger manager, and desktop administrative interface for the BankFlow retail banking ecosystem.

### Key Architectural Responsibilities:
- 🌐 **Web Banking Experience:** Desktop-optimized internet banking console built with Laravel, Inertia.js, and Tailwind CSS.
- 🔏 **Out-of-Band (OOB) Auth Dispatcher:** Dispatches high-priority push challenges to bound Flutter mobile devices for dual-factor web authentication and transaction signing.
- 🧾 **Multi-Biller JomPAY Batch Processing:** Allows staging and simultaneous settlement of up to twenty (20) utility, municipal, and institutional bills under a single consolidated authorization signature.
- 🏛️ **Certified 84-Month e-Statement Engine:** Queries monthly range-partitioned database tables to stream official LHDN/tax PDFs digitally signed with Adobe CDS X.509 certificates.
- 🛑 **Web Emergency Kill Switch:** Self-service lockdown mechanism with master password verification to protect compromised accounts even if the physical mobile phone is lost or stolen.
- ⚖️ **Immutable Double-Entry Ledger:** Coordinates atomic database transactions with pessimistic `FOR UPDATE` row locking to prevent double-spending across concurrent requests.

```text
+-------------------------------------------------------------------------------------------------+
|                                    LARAVEL APPLICATION GATEWAY                                  |
|                                                                                                 |
|  [Inertia / Web Client]             [REST / JSON:API Gateway]         [Asynchronous Horizon]    |
|  - Dashboard & Activity Ledger      - Mobile API Endpoints            - PayNet ISO 20022 Queue  |
|  - Multi-JomPAY Batch Staging       - eKYC Verification Router        - Push Notification Queue |
|  - e-Statement PDF Downloads        - Device Binding Verification     - Audit Log Hash Worker   |
|  - Web Kill Switch Trigger          - Cooling-Off Middleware          - CBS Webhook Dispatcher  |
+-------------------------------------------------------------------------------------------------+
                                                 │
                                                 ▼
+-------------------------------------------------------------------------------------------------+
|                                  PERSISTENCE & SECURITY TIER                                    |
|  - Eloquent ORM + AES-256 PII Encryption (`nric_hash`, `email_hash` blind indexing)            |
|  - PostgreSQL 16 (Staging / Production Cluster) | SQLite 3.42+ (Local Dev & In-Memory CI)        |
+-------------------------------------------------------------------------------------------------+
```

---

## 🛠️ Technology Stack & Dependencies

- **Framework:** Laravel 11.x / 12.x running on PHP 8.3+
- **Frontend / Styling:** Tailwind CSS v4, Inertia.js, Vite
- **Authentication & Security:** Laravel Sanctum with asymmetric token issuance, HttpOnly / SameSite=Strict session cookies, and Anti-CSRF protection
- **Background Processing:** Laravel Horizon overseeing Redis-backed queues for PayNet messaging and mobile push dispatch
- **Database Abstraction:** Dual-engine architecture supporting SQLite 3 for instant zero-dependency local development and PostgreSQL 16 Enterprise for production workloads

---

## 🚀 Quick Start (Local Development)

### 1. Environment Configuration
Navigate to the web portal directory:
```bash
cd web
```

Copy the environment template and generate application encryption keys:
```bash
cp .env.example .env
php artisan key:generate
```

### 2. Dependency Installation
```bash
# Install PHP dependencies
composer install

# Install Node dependencies and compile frontend assets
npm install
npm run build
```

### 3. Database Migration & Seeding (SQLite Local Setup)
```bash
# Ensure local SQLite file exists
touch database/database.sqlite

# Run migrations and seed synthetic demographic test fixtures
php artisan migrate --seed
```

### 4. Running the Development Server
```bash
# Start local PHP server on port 8000
php artisan serve --port=8000

# (Optional) Run Vite in watch mode for frontend development
npm run dev
```

Visit the application at: **[http://localhost:8000](http://localhost:8000)**

---

## 🧪 Automated Testing & Code Quality

BankFlow MY enforces rigorous automated testing leveraging in-memory SQLite (`:memory:`) with near-instant execution times:

```bash
# Run feature and unit test suites
php artisan test

# Run tests with code coverage report
php artisan test --coverage

# Check code formatting adhering to Laravel Pint standards
./vendor/bin/pint --test

# Automatically fix code formatting
./vendor/bin/pint
```

### Key Test Suites Implemented:
- **`DeviceBindingTest`:** Validates single-device binding enforcement, revocation of superseded devices, and 12-hour cooling-off initialization.
- **`CoolingOffMiddlewareTest`:** Verifies that outward transfer APIs return HTTP 403 during active cooling-off windows.
- **`KillSwitchTest`:** Validates complete token revocation, web session destruction, and account status suspension.
- **`LedgerConcurrencyTest`:** Verifies pessimistic row locking (`SELECT ... FOR UPDATE`) prevents double-spending under concurrent requests.

---

## 📂 Web Gateway Directory Structure

```text
web/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Web Portal & API Gateway Controllers
│   │   ├── Middleware/         # Cooling-Off, Device Binding & Security Headers
│   │   └── Requests/           # FormRequest Validation Schemas (Strict $fillable)
│   ├── Models/                 # Eloquent Models with Encrypted PII Casts
│   ├── Providers/              # Service Providers & Rate Limiting Configurations
│   └── Services/               # Domain Services: LedgerEngine, PayNetGateway, KillSwitch
├── database/
│   ├── factories/              # Synthetic Malaysian Demographic Data Factories
│   ├── migrations/             # Portable Schema Migrations (PostgreSQL & SQLite)
│   └── seeders/                # Baseline Biller & Test User Seeders
├── resources/
│   ├── css/                    # Tailwind CSS Design System
│   ├── js/                     # Inertia.js Components & Reactive UI
│   └── views/                  # Blade Templates & e-Statement PDF Views
├── routes/
│   ├── api.php                 # Mobile Client API Routes (mTLS & Sanctum)
│   ├── web.php                 # Web Portal Authenticated Routes (Session & Echo)
│   └── console.php             # Artisan Scheduled Maintenance Commands
└── tests/
    ├── Feature/                # High-Priority Regulatory & Financial Test Cases
    └── Unit/                   # Fast Domain Logic & Ledger Computation Tests
```

---

## 📚 Technical Documentation & System References
For the overall project architecture, mobile client workflows, and regulatory compliance specifications, refer to the root documentation index:
- 📋 **[System Architecture & Documentation Index](../README.md)**
- 📋 **[Software Requirements Specification (SRS)](../docs/software-requirement-specifications.md)**
- 🗄️ **[Database Architecture & Schema Specification](../docs/database-architecture-schema-specification.md)**
- 🔄 **[User Workflows & Sequence Specifications](../docs/user-workflows-sequences-specifications.md)**
- 🧪 **[Software Test Plan (STP)](../docs/software-test-plans.md)**

---

## 📄 License
This application is open-sourced software licensed under the [MIT License](LICENSE).
