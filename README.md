# Henley — Antigravity Build Prompt Pack

Nineteen sequenced prompts that build the Henley e-commerce platform described in `HenleyPRD.docx` and `Henley Sitemap.pdf`, on the specified stack: Laravel 12, Filament v4, PostgreSQL, Livewire, Tailwind CSS.

## How to use this

**Set up the workspace.** Create an empty git repository for the Henley project and open it in Antigravity. Copy `AGENTS.md` from this pack into the repository root and commit it — it holds the stack lock, the engineering rules, the design direction and the working conventions, and it is written to be read at the start of every agent session rather than pasted into prompts. If your Antigravity build reads project rules from a different location (a workspace rules panel, or a `.agent/` directory), put the same content there instead; the file is plain Markdown and location-agnostic.

Copy your brand assets into `docs/brand/` before running phase 00 — the packaging render, the homepage mockup, the collections mockup and the product page mockup. Phase 00 expects to find them there.

**Run one phase per agent session.** Paste the whole file as a single prompt. Each phase file is self-contained: context, objective, build spec, constraints, an explicit scope fence, and a definition of done. Don't merge two phases into one prompt — the scope fences are load-bearing, and an agent given phases 06 and 07 together will build a mediocre version of both.

**Review at every gate.** Each phase ends with a definition of done and a short list of things to report back. Read the report, look at the screenshots, and don't move on while something is unresolved. Phase 00 in particular ends with an explicit stop — approve the design direction before any code is written, because phases 04 through 11 all inherit from it.

**Let it verify in the browser.** Most storefront phases ask for visual confirmation at four widths. If your build has browser control, let the agent drive it; the alternative is you finding the misalignment three phases later.

## Run order

| # | Phase | Depends on | Notes |
|---|---|---|---|
| 00 | Brand absorption & design direction | — | Hard approval gate. No code. |
| 01 | Foundation, environment & conventions | 00 | |
| 02 | Data model, migrations & seeders | 01 | The phase that decides how much pain follows. |
| 03 | Authentication, roles & access control | 02 | |
| 04 | Design system & Blade components | 00, 01 | Can run alongside 02–03. |
| 05 | Storefront shell & home page | 02, 04 | |
| 06 | Catalogue, listing, filters & search | 05 | |
| 07 | Product detail page | 06 | |
| 08 | Cart, coupons & pricing engine | 07 | Owns all money maths. |
| 09 | Checkout, Razorpay & order lifecycle | 08 | Highest-risk phase. Don't rush the gate. |
| 10 | Customer account area | 09 | |
| 11 | Content pages, CMS surfaces & journal | 05 | Can run alongside 09–10. |
| 12 | Business management portal (Filament) | 02, 03, 09 | Largest phase; has a marked split point. |
| 13 | Vendor portal | 12 | |
| 14 | Versioned REST API | 09 | Can run alongside 12–13. |
| 15 | SEO, analytics & performance | 05–11 | |
| 16 | Security hardening | all features | |
| 17 | Testing, accessibility & QA | all features | |
| 18 | Infrastructure, deployment & launch | 17 | |

Three sets can run in parallel if you're using multiple agents: 04 alongside 02–03, 11 alongside 09–10, and 14 alongside 12–13. Everything else is a genuine dependency — parallelising 08 and 09 in particular will produce two pricing engines.

## Mapping to the PRD timeline

The PRD budgets 38 working days. Roughly: phase 00 covers the UI/UX allocation, phases 01–14 the development allocation, phases 15–17 the testing allocation, and phase 18 deployment. Phases 09 and 12 are each worth two or three days on their own; if the schedule slips, it will slip there.

## Decisions deferred to the agent

Several places ask the agent to choose and justify rather than follow. These are the ones worth watching for in the reports, because they shape the codebase: Sail versus plain Docker Compose (01), media library versus a hand-rolled images table (02), the taxonomy model for benefit and type facets (02), the address relationship shape (02), numbered pagination versus load-more (06), tax-inclusive versus tax-exclusive pricing (08), coupon stacking (08), single-page versus wizard checkout (09), vendor product approval workflow (13), how order-level discounts apportion across vendors (13), and whether vendors see customer contact details (13).

If you have a view on any of these already, add it to `AGENTS.md` before you start and the question goes away.

## What this pack deliberately doesn't cover

Subscriptions and refill scheduling, loyalty and referral programmes, courier API integration beyond manual tracking numbers, multi-currency and internationalisation, vendor payout settlement, marketing automation and abandoned-cart campaigns, and a mobile app. Several of these have schema hooks in phase 02 so adding them later isn't a migration crisis, but none are built.

## One thing to resolve early

Your packaging wordmark and your website wordmark are different letterforms — the pack uses a geometric rounded sans with a dot accent on the E, the site mockups use a letter-spaced serif. Phase 00 asks the agent to flag this and recommend which becomes canonical for digital. Have a view ready, because it affects the header on every page.

## Files

```
AGENTS.md                              project rules — commit to repo root
README.md                              this file
00-brand-and-design-direction.md
01-foundation-and-conventions.md
02-data-model-and-migrations.md
03-auth-and-access-control.md
04-design-system-and-components.md
05-storefront-shell-and-home.md
06-catalogue-listing-and-search.md
07-product-detail-page.md
08-cart-coupons-and-pricing.md
09-checkout-payments-and-orders.md
10-customer-account-area.md
11-content-pages-and-journal.md
12-admin-portal-filament.md
13-vendor-portal.md
14-api-v1.md
15-seo-analytics-and-performance.md
16-security-hardening.md
17-testing-and-qa.md
18-infrastructure-and-deployment.md
```
