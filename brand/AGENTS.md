# Henley — Project Rules

Persistent context for every agent session in this workspace. Read this before writing code. Do not restate it back to me; just follow it.

---

## 1. What we are building

Henley is a direct-to-consumer tea, herb and spice brand. We are building one Laravel application that serves three audiences:

| Surface | Route prefix | Audience |
|---|---|---|
| Customer storefront | `/` | Shoppers |
| Business Management Portal | `/admin` | Super Admin, Admin |
| Vendor Portal | `/vendor` | Vendors |

One codebase, one database, three guarded entry points. Do not split this into microservices or separate repos.

## 2. Locked technology stack

Do not substitute any of these without asking me first.

- **PHP** 8.3+
- **Framework** Laravel 12
- **Admin & vendor UI** Filament v4 (two separate panels)
- **Storefront UI** Blade + Livewire v3 + Tailwind CSS
- **Database** PostgreSQL (never MySQL — no `AUTO_INCREMENT`, no MySQL-only column types, no `FIND_IN_SET`)
- **Cache / sessions / queue driver** Redis
- **Queue worker** Laravel Queue under Supervisor
- **Payments** Razorpay
- **Object storage** Cloudflare R2 via the S3 driver
- **CDN / DNS** Cloudflare
- **Web server** Nginx on Ubuntu VPS
- **Version control** GitHub, feature branches

Frontend build is Vite. No React, no Vue, no Inertia, no Bootstrap, no jQuery, no component libraries with their own design opinions. Alpine.js ships with Livewire and is fine for small interactions.

## 3. Non-negotiable engineering rules

**PostgreSQL correctness.** Every migration must run cleanly on PostgreSQL. Use `jsonb` not `json` where we query into it. Money is `decimal(12,2)` — never float. Use `timestampTz` for anything time-sensitive. Add explicit indexes on foreign keys and on any column used in a `WHERE`, `ORDER BY` or `JOIN`.

**No N+1 queries.** Eager-load relations in every controller and Livewire component that renders a list. Install Laravel Debugbar in local and treat a query count above ~25 on a page as a bug to fix, not a number to accept.

**Money and stock are authoritative server-side.** Never trust a price, discount, quantity or total that arrives from the client. Recalculate every cart and order total on the server from database values on every request. Stock decrements happen inside a database transaction with row-level locking (`lockForUpdate`), never as a read-then-write.

**Validation everywhere.** Every write path uses a Form Request or a Livewire `rules()` definition. There is no such thing as an unvalidated input.

**Authorization by default.** Every admin and vendor action is checked against a Spatie permission. Vendors can only ever see and mutate their own rows — enforce this with a global scope or an explicit policy, not by hoping the query is right.

**Migrations are forward-only in shared branches.** Never edit a migration that has already been merged; write a new one.

**Seeders must produce a believable Henley catalogue.** No `Lorem ipsum`, no "Product 1". Use real-sounding tea and spice products, prices in the ₹300–₹4,000 range, and plausible customer names and orders. This matters because I will be judging the UI on seeded data.

**Tests accompany features.** Pest feature tests for every route and every money-touching or stock-touching path. A phase is not done until its tests pass.

## 4. Design direction

Henley reads as a quiet luxury apothecary — closer to a fine fragrance house than a supermarket tea aisle. The reference mockups and packaging establish the mood; treat them as the aesthetic north star rather than a pixel spec, and use your judgment on composition.

**Mood in words.** Warm ivory and bone paper stock. Deep oxblood as the single authoritative accent. Saffron red as the product's own colour, appearing through the arched window on the pack. Antique gold used like a foil edge — hairline thin, never a fill. Generous, confident whitespace. Photography that looks lit by late afternoon sun, never a flat studio.

**Palette family** (approximate — refine as you build, keep the relationships):

| Role | Value | Notes |
|---|---|---|
| Page base | `#FBF9F6` | Warm off-white, never pure `#FFF` |
| Raised surface | `#F5F3EF` | Cards, filter rails, footers |
| Border / rule | `#E5DFD6` | Hairline weight, 1px |
| Primary text | `#231C18` | Warm near-black, never `#000` |
| Secondary text | `#6E635B` | Captions, metadata |
| Oxblood (accent) | `#5C2225` | Primary buttons, active states |
| Oxblood deep | `#3E1517` | Hover, footer wells |
| Saffron | `#A6332F` | Product-derived highlight, sale flags, star ratings |
| Antique gold | `#B08B4F` | Hairlines, dividers, gift/premium cues only |
| Sage | `#7F8A6E` | Organic and in-stock cues |

Rules for colour: oxblood is the only fill colour for primary actions. Gold never fills a surface — it is a 1px line or a small icon. Saffron is for the product and for genuine urgency, not decoration. Never place a pure-black or pure-white block on the page.

**Typography.** A high-contrast display serif for headlines, set large with tight leading and a touch of negative letter-spacing — this carries most of the brand feel. A clean humanist or grotesque sans for body and UI, comfortable at 16px minimum. Eyebrow labels above section headings in small caps, wide tracking, secondary text colour. Prices set in the serif — they read as considered rather than transactional. Self-host the fonts in `resources/fonts` and serve them via Cloudflare; do not hotlink Google Fonts in production.

**Layout and motion.** Wide max-width container (around 1280–1440px) with generous gutters. Vertical section rhythm that feels editorial — sections breathe. Radii are small and consistent, except pill-shaped CTAs where they suit. Shadows are almost absent; separate with hairlines and background tone shifts instead. Motion is slow and minimal — 200–400ms ease, subtle fades and image scale on hover. No bounce, no parallax, no spinning anything. Respect `prefers-reduced-motion`.

**Copy voice.** Calm, specific, unhurried. "Add to ritual" over "Buy now" where it fits. Never exclamation marks, never all-caps shouting, never invented health claims — Henley makes wellness *gestures*, not medical promises.

## 5. Accessibility and quality floor

WCAG 2.1 AA as the floor: 4.5:1 contrast on body text, visible focus rings on every interactive element (a gold or oxblood ring, not the browser default blue), full keyboard operability, real `<label>` elements, semantic landmarks, alt text on every content image. Test every page at 375px, 768px, 1280px and 1600px. Lighthouse targets: Performance ≥ 90 mobile, Accessibility ≥ 95, SEO ≥ 95.

## 6. How I want you to work

Work phase by phase from the numbered prompt files. Within a phase: state your plan first, then implement, then verify, then summarise what changed and what is still open.

Verify visually before claiming done. Run the app, open the page in the browser, and look at it at mobile and desktop widths. If something is misaligned or the type is fighting itself, fix it before telling me it works.

Prefer editing existing files over creating parallel ones. If you are about to create `ProductServiceV2`, stop and fix `ProductService`.

Ask before: adding a dependency, changing the schema after a phase is signed off, deviating from the stack in section 2, or introducing a paid third-party service.

Never commit secrets. Everything environment-specific goes in `.env` with a documented entry in `.env.example`.

When you are blocked or a requirement is ambiguous, say so and propose the two options you see. Do not silently guess and build the wrong thing.
