# Henley Roles & Permissions Matrix Reference

This document defines the authorization architecture and granular verb-resource permission matrix for Henley's multi-audience commerce platform.

---

## 1. Role Definitions

| Role | Guard | Scope & Description | Default Users |
| :--- | :--- | :--- | :--- |
| **`super_admin`** | `web` | Super Administrator holding universal access across all systems, users, settings, and panels. Bypasses all policy gates via `Gate::before`. | `superadmin@henleytea.com` |
| **`admin`** | `web` | Business Management & Operations Admin. Full catalogue curation, order processing, refunds, coupon management, content, reviews, and analytics. Cannot manage users, roles, or destructive settings. | `admin@henleytea.com` |
| **`vendor`** | `web` | Single-Estate / Botanical Supplier Partner. Scoped strictly to their own products, inventory allocations, orders containing their items, and courier shipments. Isolated via `VendorScope` & Policies. | `estates@henleytea.com`, `spices@henleytea.com`, `gardens@henleytea.com` |
| **`customer`** | `web` | Storefront Shopper & Collector. Manages personal account profile, addresses, wishlists, reviews, and tracks own orders. | `collector@henleytea.com` |

---

## 2. Granular Permissions Matrix

| Resource Domain | Permission | Description | `super_admin` | `admin` | `vendor` | `customer` |
| :--- | :--- | :--- | :---: | :---: | :---: | :---: |
| **Panel Access** | `admin.access` | Access `/admin` Business Management Portal |  |  |  |  |
| | `vendor.access` | Access `/vendor` Estate Partner Portal |  |  |  |  |
| **Catalogue & Products** | `products.view` | View products master |  |  | *(own)* | *(published)* |
| | `products.create` | Draft new products / tea harvests |  |  |  |  |
| | `products.update` | Modify product attributes / prices |  |  | *(own)* |  |
| | `products.delete` | Archive / soft-delete products |  |  | *(own)* |  |
| | `products.publish` | Set product status to published |  |  |  |  |
| | `categories.manage` | Create, edit, sort categories |  |  |  |  |
| | `brands.manage` | Manage private reserve brand labels |  |  |  |  |
| | `taxonomies.manage` | Manage tea facets (benefit, type, caffeine) |  |  |  |  |
| **Inventory & Stock** | `inventory.view` | View current stock on hand |  |  | *(own)* |  |
| | `inventory.update` | Update variant stock thresholds |  |  | *(own)* |  |
| | `inventory.adjust` | Append manual stock movement ledger |  |  |  |  |
| **Orders & Commerce** | `orders.view` | View commercial orders |  |  | *(items)* |  |
| | `orders.view-own` | View customer's personal order history |  |  |  |  |
| | `orders.create` | Place new customer checkout order |  |  |  |  |
| | `orders.update-status` | Transition order fulfillment state |  |  | *(own)* |  |
| | `orders.cancel` | Cancel order and restock items |  |  |  |  |
| **Shipments & Logistics** | `shipments.view` | View courier tracking and manifests |  |  | *(own)* |  |
| | `shipments.manage` | Generate airway bills, dispatch tracking |  |  | *(own)* |  |
| **Payments & Refunds** | `payments.view` | View gateway transaction details |  |  |  |  |
| | `refunds.process` | Issue payment gateway refunds |  |  |  |  |
| **Promotions** | `coupons.view` | View promotional voucher campaign list |  |  |  |  |
| | `coupons.manage` | Create, activate, deactivate coupons |  |  |  |  |
| **Vendors** | `vendors.view` | View estate vendor directory |  |  | *(own)* |  |
| | `vendors.manage` | Edit vendor commissions and bank details |  |  |  |  |
| | `vendors.approve` | Approve new supplier applications |  |  |  |  |
| **Customers & Profiles**| `customers.view` | View customer accounts and notes |  |  |  |  |
| | `customers.manage` | Edit customer records & tags |  |  |  |  |
| | `profile.manage` | Update own account, password, addresses |  |  |  |  |
| **Reviews & Ratings** | `reviews.view` | View customer ratings and comments |  |  |  |  |
| | `reviews.create` | Submit product tasting review |  |  |  |  |
| | `reviews.moderate` | Approve, reject, or delete reviews |  |  |  |  |
| **Content & CMS** | `cms.manage` | Create and edit CMS pages |  |  |  |  |
| | `journal.manage` | Publish botanical journal essays |  |  |  |  |
| | `banners.manage` | Manage homepage promotional banners |  |  |  |  |
| **Analytics & Reports** | `reports.view` | View sales and revenue summaries |  |  |  |  |
| | `analytics.view` | View conversion rates and traffic metrics |  |  |  |  |
| **Users & Security** | `users.view` | View administrative user list |  |  |  |  |
| | `users.manage` | Create admins, reset credentials |  |  |  |  |
| | `roles.manage` | Assign roles and edit permission matrix |  |  |  |  |
| **Settings** | `settings.view` | View business settings & tax rates |  |  |  |  |
| | `settings.manage` | Modify global store and monetary settings|  |  |  |  |
| **Wishlists** | `wishlists.manage` | Add, remove, and share saved items |  |  |  |  |

---

## 3. Enforcement Layers

1. **Gate::before (Universal Bypass)**: `super_admin` role holds unconditional authorization for all abilities.
2. **Filament Panel Authentication (`canAccessPanel`)**:
   - `/admin` requires `role == 'admin'` or `role == 'super_admin'`. All other roles receive **HTTP 403 Forbidden**.
   - `/vendor` requires `role == 'vendor'` or `role == 'super_admin'`. All other roles receive **HTTP 403 Forbidden**.
3. **ORM Global Scopes (`VendorScope`)**: Automatically restricts `Product`, `OrderItem`, and `Shipment` database queries to `auth()->user()->vendor_id` when authenticated as a vendor.
4. **Model Policies (`App\Policies\*`)**: Enforces record-level ownership checks (e.g. `OrderPolicy::view` asserts `$order->items()->where('vendor_id', $user->vendor_id)->exists()`).
