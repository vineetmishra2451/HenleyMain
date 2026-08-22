@props([
    'text' => 'Complimentary express air courier on single-estate orders over ₹1,500',
    'link' => '/collections/single-origin-reserve',
    'dismissible' => true,
])

<div
    x-data="{
        dismissed: localStorage.getItem('henley_announcement_dismissed') === 'true',
        dismiss() {
            this.dismissed = true;
            localStorage.setItem('henley_announcement_dismissed', 'true');
        }
    }"
    x-show="!dismissed"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 max-h-12"
    x-transition:leave-end="opacity-0 max-h-0"
    class="relative bg-surface-dark text-inverse text-xs tracking-wider py-2.5 px-4 overflow-hidden z-40 border-b border-hairline/20"
>
    <div class="max-w-content mx-auto flex items-center justify-between">
        <div class="flex-1 text-center font-sans font-light text-[11px] sm:text-xs tracking-[0.08em]">
            @if ($link)
                <a href="{{ $link }}" class="hover:text-gold transition-colors inline-flex items-center gap-1.5 group">
                    <span>{{ $text }}</span>
                    <span class="inline-block transition-transform duration-200 group-hover:translate-x-0.5 text-gold">→</span>
                </a>
            @else
                <span>{{ $text }}</span>
            @endif
        </div>

        @if ($dismissible)
            <button
                type="button"
                x-on:click="dismiss()"
                aria-label="Dismiss announcement"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-muted hover:text-inverse p-1 rounded transition"
            >
                <x-icons.close class="w-3.5 h-3.5" />
            </button>
        @endif
    </div>
</div>
