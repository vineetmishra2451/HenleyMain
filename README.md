# Henley — Storefront & Business Management Platform

> **"Pure leaf. Pure intent."**  
> Direct-to-consumer tea, single-origin botanical infusions, and whole spices platform built on Laravel 12, Filament v4, Livewire v3, PostgreSQL 16, Redis 7, and Tailwind CSS.

---

## 1. System Architecture & Entry Points

Henley operates as a unified monolithic application with three guarded entry points:

| Surface | Route Prefix | Primary Audience | Tech Stack |
|---|---|---|---|
| **Storefront** | `/` | Customers & Collectors | Blade + Livewire v3 + Tailwind CSS |
| **Business Management Portal** | `/admin` | Super Admins & Curators | Filament v4 (Oxblood Theme) |
| **Estate & Vendor Portal** | `/vendor` | Agricultural & Tea Partners | Filament v4 (Botanical Sage Theme) |
| **Local Mailbox (Mailpit)** | `:8025` | Developers (Testing) | Mailpit Web Inspector |

---

## 2. Prerequisites

- **Docker Desktop** (Mac, Linux, or Windows WSL2)
- **Git**
- *(Optional on host)* **Node.js 22+** and **PHP 8.3+** (all tools run inside Sail containers)

---

## 3. First-Run Setup (One-Command Stack)

To clone the repository and launch the full Henley local environment:

```bash
# 1. Clone repository
git clone https://github.com/vineetmishra2451/HenleyMain.git henley
cd henley

# 2. Prepare environment configuration
cp .env.example .env

# 3. Boot local container stack (PostgreSQL, Redis, Mailpit, Queue Worker, App)
./vendor/bin/sail up -d

# 4. Generate application encryption key
./vendor/bin/sail artisan key:generate

# 5. Run database migrations & seed demo records
./vendor/bin/sail artisan migrate:fresh --seed

# 6. Build frontend assets
./vendor/bin/sail npm run build
```

The storefront will be live at `http://localhost`.

---

## 4. Default Seeded Credentials

| Role | Email | Password | Access Surface |
|---|---|---|---|
| **Super Administrator** | `admin@henleytea.com` | `password` | `/admin` & `/vendor` |
| **Estate / Vendor Partner** | `estates@henleytea.com` | `password` | `/vendor` |
| **Storefront Collector** | `collector@henleytea.com` | `password` | `/` |

---

## 5. Automated Quality Suite & Tests

Henley enforces strict quality gates on every commit:

```bash
# Run Pint code style fixer
./vendor/bin/sail composer lint

# Run Larastan static analysis (Level 6)
./vendor/bin/sail composer analyse

# Run automated Pest test suite
./vendor/bin/sail composer test

# Run all quality checks in sequence
./vendor/bin/sail composer check
```

---

## 6. Directory Conventions

```
app/
├── Actions/          # Single-purpose invokable classes for database writes (e.g. CreateOrderAction)
├── Services/         # Multi-step business orchestration & API integrations (e.g. RazorpayService)
├── Models/           # Thin Eloquent models with strict typing and relationships
├── Http/Requests/    # Form request validation classes
├── Livewire/         # Storefront interactive Livewire components
├── Filament/
│   ├── Admin/        # Business Management portal resources, pages, and widgets
│   └── Vendor/       # Vendor portal resources, pages, and widgets
├── Policies/         # Spatie / Laravel authorization policies
├── Enums/            # PHP 8.3 backed string enums with label() and color()
└── Support/          # Value objects (Money, Slug, Address) and helpers
```

---

## 7. Environment Variables Reference

| Variable | Default Value | Description |
|---|---|---|
| `APP_NAME` | `Henley` | Application display name |
| `APP_ENV` | `local` | Environment (`local`, `testing`, `production`) |
| `APP_KEY` | *(generated)* | AES-256-CBC application encryption key |
| `APP_TIMEZONE` | `Asia/Kolkata` | Application standard timezone |
| `APP_URL` | `http://localhost` | Canonical storefront base URL |
| `APP_CURRENCY` | `INR` | Standard transactional currency code |
| `DB_CONNECTION` | `pgsql` | Primary database driver (PostgreSQL only) |
| `DB_HOST` | `pgsql` | Database container host name |
| `DB_PORT` | `5432` | Internal database port |
| `DB_DATABASE` | `henley` | PostgreSQL database name |
| `DB_USERNAME` | `sail` | Database user |
| `DB_PASSWORD` | `password` | Database password |
| `FORWARD_DB_PORT` | `54320` | Host port forwarded for PostgreSQL |
| `REDIS_HOST` | `redis` | Redis service hostname |
| `FORWARD_REDIS_PORT` | `63790` | Host port forwarded for Redis |
| `SESSION_DRIVER` | `redis` | Session storage engine |
| `CACHE_STORE` | `redis` | Application cache storage engine |
| `QUEUE_CONNECTION` | `redis` | Background queue broker |
| `FILESYSTEM_DISK` | `public` | Default storage driver (`public` for dev, `r2` for prod) |
| `R2_ACCESS_KEY_ID` | `null` | Cloudflare R2 object storage access key ID |
| `R2_SECRET_ACCESS_KEY` | `null` | Cloudflare R2 object storage secret key |
| `R2_BUCKET` | `henley-media` | Cloudflare R2 storage bucket name |
| `R2_PUBLIC_URL` | `https://media.henleytea.com` | CDN public delivery URL for media assets |
| `MAIL_MAILER` | `smtp` | Mail transport driver |
| `MAIL_HOST` | `mailpit` | Local SMTP capture host |
| `MAIL_PORT` | `1025` | Local SMTP capture port |
| `FORWARD_MAILPIT_DASHBOARD_PORT` | `8025` | Mailpit Web UI port (`http://localhost:8025`) |
| `RAZORPAY_KEY_ID` | `rzp_test_placeholder` | Razorpay API Key ID |
| `RAZORPAY_KEY_SECRET` | `rzp_secret_placeholder` | Razorpay API Key Secret |
| `RAZORPAY_WEBHOOK_SECRET`| `rzp_webhook_placeholder`| Razorpay Webhook Signing Secret |
| `HENLEY_FREE_SHIPPING_THRESHOLD_PAISE` | `100000` | Free shipping threshold in paise (₹1,000.00) |
| `HENLEY_DEFAULT_GST_RATE` | `5.0` | Standard GST tax percentage on tea & botanicals |
