# Henley Storefront Frontend & Livewire Conventions

This document establishes the canonical patterns and architectural standards for all client-facing UI in Henley. Every subsequent phase (catalog, product detail, cart, checkout) must adhere to these established conventions.

---

## 1. Zero Hex Policy & Semantic Token Usage

No template may use arbitrary hex values (`#5C2225`) or raw palette names (`text-red-900`). All styling MUST reference semantic tokens defined in `tailwind.config.js`:

| Role | Semantic Class | DO NOT USE |
| :--- | :--- | :--- |
| **Page Canvas** | `bg-canvas` / `bg-page` | `bg-[#FBF9F6]` / `bg-stone-50` |
| **Raised Card Surface** | `bg-surface-raised` | `bg-[#F5F3EF]` / `bg-gray-100` |
| **White Input Well** | `bg-surface-card` | `bg-white` |
| **Primary Action (Oxblood)** | `bg-accent text-inverse` | `bg-[#5C2225]` / `bg-red-800` |
| **Product Star / Sale** | `text-saffron` / `bg-saffron` | `text-[#A6332F]` / `text-rose-700` |
| **Botanical / In-Stock** | `text-sage` / `bg-sage` | `text-[#7F8A6E]` / `text-green-600` |
| **Antique Gold Foil** | `border-gold` / `text-gold` | `border-[#B08B4F]` / `border-amber-600` |
| **Hairline Structural Border**| `border-hairline` | `border-[#E5DFD6]` / `border-gray-200` |

---

## 2. Livewire Core Architecture Patterns

### Pattern A: Loading States (`wire:loading`)

Always provide visual feedback on actions without causing layout shift. Use Henley's `<x-spinner />` or targeted loading messages:

```blade
<x-button
    type="submit"
    wire:loading.attr="disabled"
    wire:target="addToCart"
    trailing-arrow
>
    <span wire:loading.remove wire:target="addToCart">Add to Ritual</span>
    <span wire:loading wire:target="addToCart" class="inline-flex items-center gap-2">
        <x-spinner size="sm" color="white" />
        <span>Sealing...</span>
    </span>
</x-button>
```

---

### Pattern B: Optimistic UI Updates

Where an operation is safe and highly predictable (e.g. toggling a wishlist item, selecting a quantity), update the local state immediately:

```blade
<!-- Optimistic wishlist heart toggle -->
<button
    type="button"
    x-data="{ wishlisted: {{ $isWishlisted ? 'true' : 'false' }} }"
    x-on:click="wishlisted = !wishlisted; $wire.toggleWishlist({{ $productId }})"
    aria-label="Save to ritual wishlist"
    class="p-2 rounded-full border border-hairline text-secondary hover:text-accent hover:border-accent transition"
>
    <x-icons.heart x-bind:class="{ 'fill-accent text-accent': wishlisted, 'text-secondary': !wishlisted }" class="w-4 h-4" />
</button>
```

---

### Pattern C: SPA Navigation & Global Progress (`wire:navigate`)

All internal storefront links use `wire:navigate` for instant SPA-like page transitions:

```blade
<!-- Internal navigation -->
<a href="/collections/darjeeling-first-flush" wire:navigate class="hover:text-accent transition-colors">
    First Flush Darjeeling
</a>
```

Global progress bar indicator is registered in `resources/views/components/layouts/app.blade.php`:

```html
<!-- Livewire SPA Loading Bar -->
<div wire:loading.class="w-full opacity-100" class="fixed top-0 left-0 h-0.5 bg-accent z-[9999] transition-all duration-300 w-0 opacity-0 pointer-events-none"></div>
```

---

### Pattern D: Event Dispatch & Global Synchronization

Cross-component communication (such as updating the mini-cart drawer from a product card or firing toast notifications) uses typed event dispatches:

```php
// Inside Livewire Component:
$this->dispatch('cart-updated', count: $cart->item_count, subtotal: $cart->subtotal->formatted());
$this->dispatch('notify', tone: 'success', message: 'First Flush Darjeeling added to ritual.');
```

```blade
<!-- Mini-cart badge listening to dispatch: -->
<div x-data="{ count: {{ $cartCount }} }" x-on:cart-updated.window="count = $event.detail.count">
    <x-icons.bag class="w-5 h-5" />
    <span x-show="count > 0" x-text="count" class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-accent text-[9px] text-inverse font-bold"></span>
</div>
```

---

### Pattern E: URL-Bound Query State for Filters & Search

Facet filters, active tags, and search terms must synchronize transparently with the browser URL:

```php
namespace App\Livewire\Catalog;

use Livewire\Component;
use Livewire\Attributes\Url;

class ProductGrid extends Component
{
    #[Url(as: 'origin', history: true)]
    public array $origins = [];

    #[Url(as: 'harvest', history: true)]
    public array $harvests = [];

    #[Url(as: 'sort', history: true)]
    public string $sort = 'curated';

    #[Url(as: 'q', history: true)]
    public string $search = '';

    public function resetFilters(): void
    {
        $this->reset(['origins', 'harvests', 'search']);
    }
}
```

---

## 3. Keyboard & Assistive Technology Standards

1. **Focus Rings**: Never suppress outline without providing `:focus-visible` styling (`focus-visible:outline focus-visible:outline-2 focus-visible:outline-accent`).
2. **Dialogs & Drawers**: Must capture `keydown.escape`, trap focus within the panel, and return focus to the trigger upon closure.
3. **Form Errors**: Form validation errors must be associated with the corresponding control via `aria-describedby="[input-id]-error"` and marked with `role="alert"`.
4. **Icons**: Decorative SVGs must include `aria-hidden="true"`; standalone action icons must possess descriptive `aria-label` attributes.
