# Henley — Brand Direction & Visual System

> **"Pure leaf. Pure intent."**  
> Henley approaches tea, botanicals, and spices with the restraint, precision, and quiet luxury of a fine fragrance house. Customers are not buying a fast-moving beverage; they are investing in fifteen unhurried minutes of personal ritual. Every digital surface reflects this philosophy: warm uncoated paper tones, hairlines of antique gold foil, a single decisive oxblood accent, and generous editorial space.

---

## 1. Executive Summary & Design Foundations

Henley's digital experience is grounded in five foundational pillars:

1. **Warm Neutrals as Paper Stock**: Pure white (`#FFFFFF`) and cold grays are banished from large surfaces. The base tone is `#FBF9F6`, giving the viewport the physical tactility of heavy, warm, uncoated archival paper.
2. **Singular Authoritative Accent (Oxblood)**: Primary calls-to-action and active states use `#5C2225`. Because it is used sparingly, its appearance is decisive and purposeful.
3. **Product-Owned Highlighting (Saffron)**: The vivid saffron crimson (`#A6332F`) belongs exclusively to the product itself—star ratings, sale cues, and organic urgency.
4. **Foil Behavior for Antique Gold**: Antique Gold (`#B08B4F`) behaves strictly like metallic foil stamping: 1px hairline rules, delicate circular badges, and small icons. It never fills a container surface.
5. **Quiet Sage for Botanical & Stock Cues**: Sage (`#7F8A6E`) provides calm validation for organic certifications, single-origin sourcing, and live in-stock states.

---

## 2. Color Palette & Roles

```
┌────────────────────────────────────────────────────────────────────────┐
│  PAGE BASE            RAISED SURFACE       HAIRLINE NEUTRAL            │
│  #FBF9F6              #F5F3EF              #E5DFD6                     │
├────────────────────────────────────────────────────────────────────────┤
│  TEXT PRIMARY         TEXT SECONDARY       TEXT MUTED                  │
│  #231C18              #6E635B              #8E8278                     │
├────────────────────────────────────────────────────────────────────────┤
│  OXBLOOD (PRIMARY)    OXBLOOD DEEP/HOVER   SAFFRON (PRODUCT)           │
│  #5C2225              #3E1517              #A6332F                     │
├────────────────────────────────────────────────────────────────────────┤
│  ANTIQUE GOLD (FOIL)  SAGE (BOTANICAL)     ERROR / ALERT               │
│  #B08B4F              #7F8A6E              #9B2C2C                     │
└────────────────────────────────────────────────────────────────────────┘
```

### Complete Palette Specification

| Token / Role | Hex Code | RGB | Role & Usage Rules |
|---|---|---|---|
| `page-base` | `#FBF9F6` | `rgb(251, 249, 246)` | Global canvas background. Simulates warm uncoated ivory paper stock. |
| `surface-raised` | `#F5F3EF` | `rgb(245, 243, 239)` | Cards, sidebar rails, filter accordions, table rows, footer background. |
| `surface-card` | `#FFFFFF` | `rgb(255, 255, 255)` | Pure white contrast reserved for form input wells and modal dialog surfaces. |
| `surface-dark` | `#1D1714` | `rgb(29, 23, 20)` | Optional deep charcoal well for high-contrast contrast sections or dark drawers. |
| `hairline-neutral` | `#E5DFD6` | `rgb(229, 223, 214)` | 1px borders, card outlines, subtle dividers, horizontal rules. |
| `hairline-gold` | `#B08B4F` | `rgb(176, 139, 79)` | 1px antique gold foil lines, packaging trim lines, delicate ring badges. |
| `text-primary` | `#231C18` | `rgb(35, 28, 24)` | Headlines, body copy, prices, form labels, primary navigation links. |
| `text-secondary` | `#6E635B` | `rgb(110, 99, 91)` | Subtitles, metadata, captions, timestamps, eyebrow labels. |
| `text-muted` | `#8E8278` | `rgb(142, 130, 120)` | Placeholder copy, disabled options, subtle helper notes. |
| `text-on-dark` | `#FBF9F6` | `rgb(251, 249, 246)` | High-contrast text rendered over oxblood or dark wells. |
| `oxblood` | `#5C2225` | `rgb(92, 34, 37)` | Primary button fills, active tab indicators, selected radio fills. |
| `oxblood-hover` | `#4A1B1D` | `rgb(74, 27, 29)` | Primary button hover and pressed states. |
| `oxblood-deep` | `#3E1517` | `rgb(62, 21, 23)` | Deepest oxblood well, hero container background option. |
| `saffron` | `#A6332F` | `rgb(166, 51, 47)` | Product review stars, sale ribbons, limited-harvest tags. |
| `saffron-surface` | `#FAECEB` | `rgb(250, 236, 235)` | Tinted background pill for sale/urgency badges. |
| `saffron-text` | `#8E2824` | `rgb(142, 40, 36)` | Accessible dark crimson text over saffron tinted pill surfaces. |
| `antique-gold` | `#B08B4F` | `rgb(176, 139, 79)` | 1px foil lines, small seals, premium gift iconography. |
| `gold-surface` | `#F7F3E8` | `rgb(247, 243, 232)` | Tinted background pill for curation & bestseller badges. |
| `gold-text` | `#755A25` | `rgb(117, 90, 37)` | Accessible antique gold text over gold tinted pill surfaces. |
| `sage` | `#7F8A6E` | `rgb(127, 138, 110)` | Muted botanical green for organic badges, live stock dots, leaf icons. |
| `sage-surface` | `#E8ECE3` | `rgb(232, 236, 227)` | Tinted background pill for organic / botanical certifications. |
| `sage-text` | `#3B4833` | `rgb(59, 72, 51)` | Accessible dark sage text over sage tinted pill surfaces. |
| `error` | `#9B2C2C` | `rgb(155, 44, 44)` | Validation errors, alert callouts. |
| `error-surface` | `#FFF5F5` | `rgb(255, 245, 245)` | Form input error background well. |

---

## 3. WCAG 2.1 Contrast Ratio Verification

Every text and interactive element has been mathematically evaluated against WCAG 2.1 Level AA (minimum 4.5:1 for body text < 18pt/24px; 3.0:1 for large display text ≥ 18pt/24px or 14pt/18.66px bold; 3.0:1 for graphical UI components).

### Exact Contrast Ratio Table

| Foreground (Text/Icon) | Background (Surface) | Contrast Ratio | WCAG Compliance | Usage Context |
|---|---|---|---|---|
| `text-primary` (`#231C18`) | `page-base` (`#FBF9F6`) | **15.98:1** | **Pass AAA** (≥ 7:1) | Body copy, headlines, prices |
| `text-primary` (`#231C18`) | `surface-raised` (`#F5F3EF`) | **15.15:1** | **Pass AAA** (≥ 7:1) | Card titles, sidebar copy |
| `text-primary` (`#231C18`) | `surface-card` (`#FFFFFF`) | **17.02:1** | **Pass AAA** (≥ 7:1) | Input field text, modal copy |
| `text-secondary` (`#6E635B`) | `page-base` (`#FBF9F6`) | **5.55:1** | **Pass AA** (≥ 4.5:1) | Metadata, captions, secondary labels |
| `text-secondary` (`#6E635B`) | `surface-raised` (`#F5F3EF`) | **5.27:1** | **Pass AA** (≥ 4.5:1) | Card subtitle, filter counts `(6)` |
| `text-on-dark` (`#FFFFFF`) | `oxblood` (`#5C2225`) | **12.28:1** | **Pass AAA** (≥ 7:1) | Primary button label text |
| `text-on-dark` (`#FFFFFF`) | `oxblood-hover` (`#4A1B1D`) | **14.28:1** | **Pass AAA** (≥ 7:1) | Primary button hover label |
| `text-on-dark` (`#FFFFFF`) | `oxblood-deep` (`#3E1517`) | **15.86:1** | **Pass AAA** (≥ 7:1) | Dark well typography |
| `oxblood` (`#5C2225`) | `page-base` (`#FBF9F6`) | **11.68:1** | **Pass AAA** (≥ 7:1) | Interactive text links, active tabs |
| `oxblood` (`#5C2225`) | `surface-raised` (`#F5F3EF`) | **11.08:1** | **Pass AAA** (≥ 7:1) | Card active links, category tags |
| `saffron` (`#A6332F`) | `page-base` (`#FBF9F6`) | **6.37:1** | **Pass AA** (≥ 4.5:1) | Star rating icons, price discounts |
| `saffron` (`#A6332F`) | `surface-raised` (`#F5F3EF`) | **6.04:1** | **Pass AA** (≥ 4.5:1) | Product card rating stars |
| `saffron-text` (`#8E2824`) | `saffron-surface` (`#FAECEB`) | **7.37:1** | **Pass AAA** (≥ 7:1) | "Sale" & urgency badge pills |
| `gold-text` (`#755A25`) | `gold-surface` (`#F7F3E8`) | **5.84:1** | **Pass AA** (≥ 4.5:1) | "Bestseller" & curation badge pills |
| `sage-text` (`#3B4833`) | `sage-surface` (`#E8ECE3`) | **8.12:1** | **Pass AAA** (≥ 7:1) | "100% Organic" badge pills |
| `error` (`#9B2C2C`) | `page-base` (`#FBF9F6`) | **7.16:1** | **Pass AAA** (≥ 7:1) | Inline form error message |
| `error` (`#9B2C2C`) | `error-surface` (`#FFF5F5`) | **7.40:1** | **Pass AAA** (≥ 7:1) | Form error alert container |
| `hairline-gold` (`#B08B4F`) | `page-base` (`#FBF9F6`) | **3.00:1** | **Pass UI AA** (≥ 3.0:1) | 1px foil lines & graphical icons |

> **Note on Non-Text Contrast**:  
> `antique-gold` (`#B08B4F`) achieves exactly **3.00:1** against `#FBF9F6`, fulfilling WCAG 2.1 Success Criterion 1.4.11 for non-text UI controls, icons, and hairline borders. Gold is strictly forbidden from body copy; textual badges utilize the calibrated high-contrast tone `gold-text` (`#755A25`, **5.84:1**).

---

## 4. Typography Pairing & Modular Scale

### Typography Selection & Licensing

* **Display Serif**: **Cormorant Garamond** (SIL Open Font License / OFL — 100% permissible for self-hosting).  
  *Justification*: Cormorant Garamond brings traditional apothecary refinement and high-contrast editorial elegance to headlines and prices with razor-sharp serifs, tall ascenders, and tight display leading.
* **Body & UI Sans**: **Plus Jakarta Sans** (SIL Open Font License / OFL — 100% permissible for self-hosting).  
  *Justification*: Plus Jakarta Sans provides a clean, neutral, and warm grotesque companion for UI controls, forms, and body copy, ensuring effortless legibility without competing with the display serif.

### Modular Scale Table (Major Third / 1.25 with Custom Editorial Display Ratios)

| Token / Level | Font Family | Size (px / rem) | Line Height | Tracking | Weight | Semantic Role |
|---|---|---|---|---|---|---|
| `type-display-hero` | Cormorant Garamond | 56px / 3.5rem (Desktop)<br>38px / 2.375rem (Mobile) | 1.08 | `-0.025em` | Regular (400) / Medium (500) | Hero mastheads, editorial campaign headlines |
| `type-display-1` (H1) | Cormorant Garamond | 42px / 2.625rem (Desktop)<br>32px / 2.0rem (Mobile) | 1.12 | `-0.02em` | Product detail titles, collection page headers |
| `type-display-2` (H2) | Cormorant Garamond | 32px / 2.0rem (Desktop)<br>26px / 1.625rem (Mobile) | 1.18 | `-0.015em` | Section headlines ("The Ritual", "Curated Collections") |
| `type-display-3` (H3) | Cormorant Garamond | 24px / 1.5rem | 1.24 | `-0.01em` | Medium (500) | Product card titles, drawer headings, modal titles |
| `type-price-hero` | Cormorant Garamond | 32px / 2.0rem | 1.1 | `-0.01em` | Medium (500) | Prominent product detail price (`$48.00` / `₹3,800`) |
| `type-price-card` | Cormorant Garamond | 20px / 1.25rem | 1.2 | `0em` | Medium (500) | Catalogue listing price tag (`$34.00`) |
| `type-body-lead` | Plus Jakarta Sans | 18px / 1.125rem | 1.6 | `-0.005em` | Regular (400) | Product intro synopsis, editorial standfirst |
| `type-body` | Plus Jakarta Sans | 16px / 1.0rem | 1.65 | `0em` | Regular (400) | Standard body copy, article text, descriptions |
| `type-ui` | Plus Jakarta Sans | 15px / 0.9375rem | 1.4 | `+0.01em` | Medium (500) | Button labels, form inputs, dropdown options, table cells |
| `type-eyebrow` | Plus Jakarta Sans | 12px / 0.75rem | 1.3 | `+0.18em` | SemiBold (600) | Section overlines, small caps category trackers (`PURE LEAF. PURE INTENT.`) |
| `type-caption` | Plus Jakarta Sans | 13px / 0.8125rem | 1.45 | `+0.01em` | Regular (400) / Medium (500) | Form helper text, review count `(124)`, shipping cues |
| `type-badge` | Plus Jakarta Sans | 11px / 0.6875rem | 1.2 | `+0.12em` | Bold (700) | Pill badge labels (`100% ORGANIC`, `BESTSELLER`) |

---

## 5. Spacing Scale

Rhythm is built on an unhurried 4px/8px modular base that expands into expansive editorial gutters.

| Token | Value (px / rem) | Common UI Application |
|---|---|---|
| `space-1` | 4px / 0.25rem | Hairline offsets, inline badge gaps, dot indicators |
| `space-2` | 8px / 0.5rem | Badge internal padding, rating star gaps, checkbox labels |
| `space-3` | 12px / 0.75rem | Input vertical padding, compact list item spacing |
| `space-4` | 16px / 1.0rem | Input horizontal padding, mobile card gutters, button vertical padding |
| `space-5` | 20px / 1.25rem | Mobile container padding, button horizontal padding |
| `space-6` | 24px / 1.5rem | Card internal padding, desktop button horizontal padding, accordion header gaps |
| `space-8` | 32px / 2.0rem | Grid column gutters, form group vertical separation |
| `space-12` | 48px / 3.0rem | Component block separation, product detail rail gaps |
| `space-16` | 64px / 4.0rem | Section vertical padding on mobile viewport |
| `space-24` | 96px / 6.0rem | Section vertical padding on desktop viewport |
| `space-32` | 128px / 8.0rem | Hero section vertical padding, major editorial chapter breaks |

---

## 6. Radii, Border Weights & Shadow Policy

### Radii Scale
* `radius-none` (`0px`): Crisp table edges, full-bleed imagery.
* `radius-sm` (`4px`): Micro tooltips, small input tags.
* `radius-md` (`8px`): Form inputs, select dropdowns, accordion cards.
* `radius-lg` (`12px`): Product cards, testimonial panels, image containers.
* `radius-xl` (`16px`): Highlight frames, modal surfaces.
* `radius-arch` (`9999px 9999px 0 0`): Top-curved apothecary window frames and category portals.
* `radius-full` (`9999px`): Pill CTA buttons (`ADD TO RITUAL →`), pill filter chips, pill status badges.

### Border Weights & Rules
* `border-hairline` (`1px solid`): The primary structural separator. Used on cards, dividers, table rows, and input resting states.
* `border-focus` (`2px solid` with `2px` offset): High-contrast accessible focus indicator using `oxblood` (`#5C2225`) or `antique-gold` (`#B08B4F`). Never default browser blue.

### Shadow Policy (Near-Zero Ambient Light)
Henley rejects aggressive drop shadows and synthetic depth. Hierarchy is established exclusively through surface tone shifts (`#FBF9F6` vs `#F5F3EF`) and 1px hairline rules (`#E5DFD6`).
* `shadow-none`: Default for all static cards, sections, and buttons.
* `shadow-subtle` (`0 4px 20px -2px rgba(35, 28, 24, 0.04)`): Warm-tinted whisper shadow permitted only for floating dropdown menus and sticky header navigation on scroll.
* `shadow-hover` (`0 10px 30px -4px rgba(35, 28, 24, 0.07)`): Soft lift on interactive product cards during cursor hover.

---

## 7. Motion & Interaction Policy

* **Pacing**: Unhurried and organic. Micro-interactions run at `250ms–350ms`. Viewport transitions and drawer revelations run at `400ms–500ms`.
* **Easing Curve**: `cubic-bezier(0.25, 1, 0.5, 1)` (smooth deceleration curve; zero bounce, zero spring overshoot, zero mechanical stiffness).
* **Hover Gestures**:
  * Product card images: subtle `1.03x` scale with `500ms` ease.
  * Buttons: background color fade over `250ms` with subtle `translateX(3px)` on the trailing arrow (`→`).
* **Accessibility**: Full respect for `@media (prefers-reduced-motion: reduce)`. When active, all durations collapse to `0ms` or simple instantaneous `100ms` opacity cross-fades.

---

## 8. Accent Colour Usage Governance

```
┌─────────────────┬───────────────────────────────────────────────────────┐
│ ACCENT          │ STRICT USAGE GOVERNANCE                               │
├─────────────────┼───────────────────────────────────────────────────────┤
│ Oxblood         │ • Sole fill color for primary actions & active tabs   │
│ (#5C2225)       │ • Forbidden from backgrounds of large content areas   │
├─────────────────┼───────────────────────────────────────────────────────┤
│ Saffron         │ • Product ratings (5-stars), sale tags, harvest flags │
│ (#A6332F)       │ • Forbidden from standard buttons or generic dividers │
├─────────────────┼───────────────────────────────────────────────────────┤
│ Antique Gold    │ • 1px hairline borders, foil accents, circular seals  │
│ (#B08B4F)       │ • Strictly forbidden from filling rectangular areas   │
├─────────────────┼───────────────────────────────────────────────────────┤
│ Sage            │ • Organic certification pills & in-stock status dots  │
│ (#7F8A6E)       │ • Quiet botanical companion to oxblood                │
└─────────────────┴───────────────────────────────────────────────────────┘
```

---

## 9. The Signature Geometry (Apothecary Arch)

The arched apothecary window from the bone-white cylinder packaging is Henley's unmistakable geometric motif.

**Restrained Application Rules**:
1. **Hero & Story Panels**: Used as an image mask or back-wall architectural niche behind the featured cylinder render (exactly as shown in `brand/product.jpeg` and `brand/homepage.jpeg`).
2. **Category Showcase**: Used as an arched frame for editorial category gateways (e.g. "Herbal Infusions" arch).
3. **Usage Frequency**: Maximum 1–2 appearances per page viewport.
4. **Strict Prohibition**: Never applied repeatedly to every product card in a catalog grid. Repetition transforms an architectural signature into a superficial gimmick.

---

## 10. Canonical Wordmark Resolution

### Discrepancy Analysis
* **Packaging Wordmark (`brand/logo.png` / `brand/product.jpeg`)**: Custom geometric rounded sans letterforms with whimsical, organic dot accents on letters (`H E N L E Y`).
* **Mockup Masthead (`brand/collectionpage.jpeg` / `brand/productpage.jpeg`)**: Letter-spaced classical high-contrast serif.

### Recommendation: Canonical Digital Wordmark
We recommend adopting the **original bespoke geometric dotted sans mark (`brand/logo.png`)** as the **canonical digital wordmark (rendered as an ultra-sharp vector SVG)** across the storefront masthead, mobile drawer, and footer.

### Strategic Rationale
1. **Omnichannel Physical Cohesion**: The physical cylinder pack is the ultimate ritual artifact. Mirroring the exact packaging wordmark in the digital header bridges the online store directly to the tangible unboxing experience.
2. **Proprietary Distinctiveness**: Wide-spaced serif headers are ubiquitous across modern lifestyle brands (Aesop, Le Labo, Byredo). Henley’s dotted geometric mark is unmistakably unique, legally defensible, and instantly recognizable.
3. **Typographic Hierarchy & Harmony**: Because page headlines, collection names, and prices are set in Cormorant Garamond (Serif), utilizing the geometric dotted wordmark in the header creates a pleasing visual counterpoint (Brand Mark = Geometric Sans, Editorial Voice = High-Contrast Serif) without serif redundancy.
