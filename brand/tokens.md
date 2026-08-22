# Henley Semantic Design Tokens Reference

## 1. Color Palette & Semantic Roles

| Semantic Token | Tailwind Class | Hex / Value | Description |
| :--- | :--- | :--- | :--- |
| **Canvas Base** | `bg-canvas` / `bg-page` | `#FBF9F6` | Warm uncoated ivory paper canvas |
| **Surface** | `bg-surface` | `#FBF9F6` | Standard surface |
| **Surface Raised** | `bg-surface-raised` | `#F5F3EF` | Cards, table rows, filter panels |
| **Surface Card** | `bg-surface-card` | `#FFFFFF` | Form input wells, pure white contrast |
| **Surface Dark** | `bg-surface-dark` | `#1D1714` | High contrast sections |
| **Text Primary** | `text-primary` | `#231C18` | Headlines, body copy, prices |
| **Text Secondary** | `text-secondary` | `#6E635B` | Subtitles, metadata, captions |
| **Text Muted** | `text-muted` | `#8E8278` | Placeholder copy, helper notes |
| **Text Inverse** | `text-inverse` | `#FBF9F6` | High-contrast text on dark / oxblood |
| **Accent / Oxblood** | `bg-accent` / `text-accent` | `#5C2225` | Primary buttons, active tabs, links |
| **Accent Hover** | `bg-accent-hover` | `#4A1B1D` | Primary button hover |
| **Accent Deep** | `bg-accent-deep` | `#3E1517` | Deepest oxblood well |
| **Saffron** | `bg-saffron` / `text-saffron` | `#A6332F` | Product review stars, sale ribbons |
| **Saffron Surface** | `bg-saffron-surface` | `#FAECEB` | Tinted sale/urgency pill background |
| **Saffron Text** | `text-saffron-text` | `#8E2824` | Accessible crimson text on saffron pill |
| **Antique Gold (Foil)** | `border-gold` / `text-gold` | `#B08B4F` | 1px foil lines, seals, icons |
| **Gold Surface** | `bg-gold-surface` | `#F7F3E8` | Tinted curation pill background |
| **Gold Text** | `text-gold-text` | `#755A25` | Accessible gold text on gold pill |
| **Sage (Botanical)** | `text-sage` / `bg-sage` | `#7F8A6E` | In-stock dot, organic leaf icon |
| **Sage Surface** | `bg-sage-surface` | `#E8ECE3` | Tinted organic pill background |
| **Sage Text** | `text-sage-text` | `#3B4833` | Accessible sage text on sage pill |
| **Hairline Neutral** | `border-hairline` | `#E5DFD6` | 1px dividers, card borders |
| **Hairline Gold** | `border-gold` | `#B08B4F` | 1px foil rules |
| **Alert Error** | `text-error` / `bg-error` | `#9B2C2C` | Validation errors |
| **Alert Error Surface**| `bg-error-surface` | `#FFF5F5` | Error alert container well |

---

## 2. Typography Scale

- `font-serif`: `Cormorant Garamond`, Georgia, serif
- `font-sans`: `Plus Jakarta Sans`, -apple-system, sans-serif

| Token | Size | Line Height | Tracking | Weight | Role |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `text-display-hero` | `3.5rem` (56px) | `1.08` | `-0.025em` | 400/500 | Hero masthead |
| `text-display-1` | `2.625rem` (42px) | `1.12` | `-0.02em` | 400 | Product title, collection header (H1) |
| `text-display-2` | `2.0rem` (32px) | `1.18` | `-0.015em` | 400 | Section headlines (H2) |
| `text-display-3` | `1.5rem` (24px) | `1.24` | `-0.01em` | 500 | Card titles, modal headers (H3) |
| `text-price-hero` | `2.0rem` (32px) | `1.10` | `-0.01em` | 500 | Main PDP price |
| `text-price-card` | `1.25rem` (20px) | `1.20` | `0em` | 500 | Catalog card price |
| `text-body-lead` | `1.125rem` (18px) | `1.60` | `-0.005em` | 400 | Introductory synopsis |
| `text-body` | `1.0rem` (16px) | `1.65` | `0em` | 400 | Standard body copy |
| `text-ui` | `0.9375rem` (15px) | `1.40` | `+0.01em` | 500 | Buttons, inputs, controls |
| `text-eyebrow` | `0.75rem` (12px) | `1.30` | `+0.18em` | 600 | Small caps overlines |
| `text-caption` | `0.8125rem` (13px) | `1.45` | `+0.01em` | 400/500| Helper text, counts |
| `text-badge` | `0.6875rem` (11px) | `1.20` | `+0.12em` | 700 | Pill tags |

---

## 3. Spacing Scale

`space-1` (4px), `space-2` (8px), `space-3` (12px), `space-4` (16px), `space-5` (20px), `space-6` (24px), `space-8` (32px), `space-12` (48px), `space-16` (64px), `space-24` (96px), `space-32` (128px).

---

## 4. Radii & Shadows

- `rounded-none` (`0px`)
- `rounded-sm` (`4px`)
- `rounded-md` (`8px`)
- `rounded-lg` (`12px`)
- `rounded-xl` (`16px`)
- `rounded-arch` (`9999px 9999px 0 0`)
- `rounded-full` (`9999px`)
- `shadow-subtle`: `0 4px 20px -2px rgba(35, 28, 24, 0.04)`
- `shadow-hover`: `0 10px 30px -4px rgba(35, 28, 24, 0.07)`
- `transition-henley`: `cubic-bezier(0.25, 1, 0.5, 1)`
