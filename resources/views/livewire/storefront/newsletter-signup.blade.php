<div>
    @if ($subscribed)
        <div class="rounded-xl border border-emerald-300 bg-emerald-50/60 p-4 text-center">
            <div class="flex items-center justify-center gap-2 text-emerald-800 font-medium text-sm">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                <span>You are subscribed. Welcome to the ritual.</span>
            </div>
            <p class="mt-1 text-xs text-emerald-700/80">A confirmation has been sent to your inbox.</p>
        </div>
    @else
        <form wire:submit="subscribe" class="space-y-3">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 max-w-md mx-auto">
                <div class="relative flex-1">
                    <input
                        type="email"
                        wire:model="email"
                        placeholder="Your email address"
                        required
                        aria-label="Email address for newsletter"
                        class="w-full h-12 px-5 text-sm font-sans bg-ivory border border-border rounded-full text-charcoal placeholder:text-charcoal/40 focus:outline-none focus:border-maroon transition-colors {{ $errors->has('email') ? 'border-terracotta ring-1 ring-terracotta' : '' }}"
                    >
                </div>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="h-12 px-7 rounded-full text-xs font-sans font-medium uppercase tracking-wider bg-maroon text-ivory hover:bg-maroon-dark transition-colors cursor-pointer shadow-subtle flex-shrink-0"
                >
                    <span wire:loading.remove wire:target="subscribe">Subscribe</span>
                    <span wire:loading wire:target="subscribe" class="inline-flex items-center gap-1.5">
                        <x-spinner size="sm" color="white" />
                        <span>Subscribing...</span>
                    </span>
                </button>
            </div>

            @error('email')
                <p role="alert" class="text-xs text-terracotta text-center font-medium">{{ $message }}</p>
            @enderror
        </form>
    @endif
</div>
