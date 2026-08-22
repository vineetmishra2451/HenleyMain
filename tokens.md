# Henley — Design Tokens & Tailwind Theme Definition

> **Phase 04 Transcription Guide**: This document establishes the semantic design tokens for Henley. All names are semantic roles rather than literal color/dimension names (e.g. `surface-raised` instead of `cream-100`), directly mapping to Tailwind CSS theme extensions and CSS custom properties.

---

## 1. Color Tokens (`theme.extend.colors`)

```javascript
// tailwind.config.js color mapping
colors: {
  // Canvases and Structural Surfaces
  canvas: {
    DEFAULT: 'var(--color-page-base)',         // #FBF9F6 - Warm off-white global canvas
    base: 'var(--color-page-base)',            // #FBF9F6
  },
  surface: {
    DEFAULT: 'var(--color-surface-raised)',    // #F5F3EF - Secondary surface
    raised: 'var(--color-surface-raised)',     // #F5F3EF - Cards, sidebar rails, footer
    card: 'var(--color-surface-card)',         // #FFFFFF - White wells & input fields
    dark: 'var(--color-surface-dark)',         // #1D1714 - Deep charcoal drawer/sections
  },

  // Hairlines, Dividers & Structural Rules
  border: {
    DEFAULT: 'var(--color-hairline-neutral)',  // #E5DFD6 - 1px standard rule
    neutral: 'var(--color-hairline-neutral)',  // #E5DFD6
    gold: 'var(--color-hairline-gold)',        // #B08B4F - 1px antique gold foil accent
    focus: 'var(--color-oxblood)',             // #5C2225 - Focus ring state
    error: 'var(--color-border-error)',        // #E53E3E - Form validation error border
  },

  // Typography & Content Hierarchies
  content: {
    primary: 'var(--color-text-primary)',      // #231C18 - Near-black editorial copy (15.98:1)
    secondary: 'var(--color-text-secondary)',  // #6E635B - Subtitles, metadata, captions (5.55:1)
    muted: 'var(--color-text-muted)',          // #8E8278 - Placeholders & disabled labels
    inverse: 'var(--color-text-on-dark)',      // #FBF9F6 - Typography on dark/oxblood wells
  },

  // Brand Accents & Interactive Roles
  oxblood: {
    DEFAULT: 'var(--color-oxblood)',           // #5C2225 - Primary CTA fill & active indicator
    hover: 'var(--color-oxblood-hover)',       // #4A1B1D - Interactive hover & active click
    deep: 'var(--color-oxblood-deep)',         // #3E1517 - Deep container background
  },
  saffron: {
    DEFAULT: 'var(--color-saffron)',           // #A6332F - Product star ratings, sale highlight
    surface: 'var(--color-saffron-surface)',   // #FAECEB - Saffron tinted pill background
    text: 'var(--color-saffron-text)',         // #8E2824 - Accessible crimson text (7.37:1)
  },
  gold: {
    DEFAULT: 'var(--color-antique-gold)',      // #B08B4F - Foil rules, circular seals, icons
    surface: 'var(--color-gold-surface)',       // #F7F3E8 - Bestseller badge pill background
    text: 'var(--color-gold-text)',            // #755A25 - Accessible gold text (5.84:1)
  },
  sage: {
    DEFAULT: 'var(--color-sage)',              // #7F8A6E - Botanical icons & in-stock dot
    surface: 'var(--color-sage-surface)',      // #E8ECE3 - Organic badge pill background
    text: 'var(--color-sage-text)',            // #3B4833 - Accessible sage text (8.12:1)
  },
  alert: {
    error: 'var(--color-error-text)',          // #9B2C2C - Error text & warning notices
    errorSurface: 'var(--color-error-surface)',// #FFF5F5 - Error alert container
  }
}
```

---

## 2. CSS Custom Properties (`resources/css/app.css`)

```css
:root {
  /* Surfaces */
  --color-page-base: #FBF9F6;
  --color-surface-raised: #F5F3EF;
  --color-surface-card: #FFFFFF;
  --color-surface-dark: #1D1714;

  /* Hairlines & Borders */
  --color-hairline-neutral: #E5DFD6;
  --color-hairline-gold: #B08B4F;
  --color-border-error: #E53E3E;

  /* Typography */
  --color-text-primary: #231C18;
  --color-text-secondary: #6E635B;
  --color-text-muted: #8E8278;
  --color-text-on-dark: #FBF9F6;

  /* Brand Accents */
  --color-oxblood: #5C2225;
  --color-oxblood-hover: #4A1B1D;
  --color-oxblood-deep: #3E1517;

  --color-saffron: #A6332F;
  --color-saffron-surface: #FAECEB;
  --color-saffron-text: #8E2824;

  --color-antique-gold: #B08B4F;
  --color-gold-surface: #F7F3E8;
  --color-gold-text: #755A25;

  --color-sage: #7F8A6E;
  --color-sage-surface: #E8ECE3;
  --color-sage-text: #3B4833;

  --color-error-text: #9B2C2C;
  --color-error-surface: #FFF5F5;
}
```

---

## 3. Typography Tokens (`theme.extend`)

### Font Families (`fontFamily`)
```javascript
fontFamily: {
  serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
  sans: ['"Plus Jakarta Sans"', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
  display: ['"Cormorant Garamond"', 'Georgia', 'serif'],
}
```

### Font Sizes & Line Heights (`fontSize`)
```javascript
fontSize: {
  // Display Serif Levels
  'display-hero': ['3.5rem', { lineHeight: '1.08', letterSpacing: '-0.025em' }],   // 56px (Desktop)
  'display-hero-mobile': ['2.375rem', { lineHeight: '1.1', letterSpacing: '-0.02em' }], // 38px
  'display-1': ['2.625rem', { lineHeight: '1.12', letterSpacing: '-0.02em' }],       // 42px (H1)
  'display-2': ['2.0rem', { lineHeight: '1.18', letterSpacing: '-0.015em' }],        // 32px (H2)
  'display-3': ['1.5rem', { lineHeight: '1.24', letterSpacing: '-0.01em' }],         // 24px (H3)

  // Price Display Levels (Considered Serif)
  'price-hero': ['2.0rem', { lineHeight: '1.1', letterSpacing: '-0.01em' }],         // 32px
  'price-card': ['1.25rem', { lineHeight: '1.2', letterSpacing: '0em' }],            // 20px

  // Body & UI Sans Levels
  'body-lead': ['1.125rem', { lineHeight: '1.6', letterSpacing: '-0.005em' }],       // 18px
  'body-base': ['1.0rem', { lineHeight: '1.65', letterSpacing: '0em' }],             // 16px (Minimum)
  'ui-base': ['0.9375rem', { lineHeight: '1.4', letterSpacing: '0.01em' }],          // 15px
  'caption': ['0.8125rem', { lineHeight: '1.45', letterSpacing: '0.01em' }],         // 13px
  'eyebrow': ['0.75rem', { lineHeight: '1.3', letterSpacing: '0.18em' }],            // 12px (Small Caps)
  'badge': ['0.6875rem', { lineHeight: '1.2', letterSpacing: '0.12em' }],            // 11px
}
```

---

## 4. Spacing Scale (`theme.extend.spacing`)

```javascript
spacing: {
  '1': '0.25rem',    // 4px - Hairline offsets & micro gaps
  '2': '0.5rem',     // 8px - Badge padding & rating star gaps
  '3': '0.75rem',    // 12px - Form input vertical padding
  '4': '1.0rem',     // 16px - Mobile gutters & button vertical padding
  '5': '1.25rem',    // 20px - Mobile horizontal padding
  '6': '1.5rem',     // 24px - Card internal padding & desktop button padding
  '8': '2.0rem',     // 32px - Grid column gaps & form groupings
  '12': '3.0rem',    // 48px - Subsection separation
  '16': '4.0rem',    // 64px - Section vertical rhythm (Mobile)
  '24': '6.0rem',    // 96px - Section vertical rhythm (Desktop)
  '32': '8.0rem',    // 128px - Hero & major editorial chapter spacing
}
```

---

## 5. Border Radii Tokens (`theme.extend.borderRadius`)

```javascript
borderRadius: {
  'none': '0px',
  'sm': '4px',       // Micro tooltips, small tags
  'md': '8px',       // Form inputs, dropdown menus, accordion headers
  'lg': '12px',      // Standard product cards, filter panels
  'xl': '16px',      // Feature frames, modal overlays
  'arch': '9999px 9999px 0 0', // Apothecary signature top-arch mask
  'full': '9999px',  // Pill buttons, filter chips, status badges
}
```

---

## 6. Shadows (`theme.extend.boxShadow`)

```javascript
boxShadow: {
  'none': 'none',
  'subtle': '0 4px 20px -2px rgba(35, 28, 24, 0.04)', // Floating menus & sticky masthead
  'card-hover': '0 10px 30px -4px rgba(35, 28, 24, 0.07)', // Soft lift on interactive cards
}
```

---

## 7. Transitions & Motion (`theme.extend.transitionTimingFunction`)

```javascript
transitionTimingFunction: {
  'henley': 'cubic-bezier(0.25, 1, 0.5, 1)', // Smooth, unhurried, luxury deceleration
},
transitionDuration: {
  'instant': '100ms',
  'interactive': '250ms', // Button hovers, checkbox toggles
  'expand': '350ms',      // Accordion dropdowns, tab cross-fades
  'editorial': '500ms',   // Modal slide, image zoom, category reveals
}
```

---

## 8. Consolidated `tailwind.config.js` Export Template

```javascript
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        canvas: {
          DEFAULT: '#FBF9F6',
          base: '#FBF9F6',
        },
        surface: {
          DEFAULT: '#F5F3EF',
          raised: '#F5F3EF',
          card: '#FFFFFF',
          dark: '#1D1714',
        },
        border: {
          DEFAULT: '#E5DFD6',
          neutral: '#E5DFD6',
          gold: '#B08B4F',
          error: '#E53E3E',
        },
        content: {
          primary: '#231C18',
          secondary: '#6E635B',
          muted: '#8E8278',
          inverse: '#FBF9F6',
        },
        oxblood: {
          DEFAULT: '#5C2225',
          hover: '#4A1B1D',
          deep: '#3E1517',
        },
        saffron: {
          DEFAULT: '#A6332F',
          surface: '#FAECEB',
          text: '#8E2824',
        },
        gold: {
          DEFAULT: '#B08B4F',
          surface: '#F7F3E8',
          text: '#755A25',
        },
        sage: {
          DEFAULT: '#7F8A6E',
          surface: '#E8ECE3',
          text: '#3B4833',
        },
        alert: {
          error: '#9B2C2C',
          errorSurface: '#FFF5F5',
        }
      },
      fontFamily: {
        serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
        sans: ['"Plus Jakarta Sans"', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
      },
      borderRadius: {
        'sm': '4px',
        'md': '8px',
        'lg': '12px',
        'xl': '16px',
        'arch': '9999px 9999px 0 0',
        'full': '9999px',
      },
      boxShadow: {
        'subtle': '0 4px 20px -2px rgba(35, 28, 24, 0.04)',
        'card-hover': '0 10px 30px -4px rgba(35, 28, 24, 0.07)',
      },
      transitionTimingFunction: {
        'henley': 'cubic-bezier(0.25, 1, 0.5, 1)',
      }
    },
  },
  plugins: [],
}
```
