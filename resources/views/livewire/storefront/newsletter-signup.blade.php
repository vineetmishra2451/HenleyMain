<div>
    @if ($subscribed)
        <div class="p-4 rounded-xl bg-sage-surface border border-sage/20 text-sage-text space-y-1">
            <span class="font-sans text-xs uppercase tracking-wider font-semibold block">Welcome to the Inner Circle</span>
            <p class="text-caption leading-snug">
                Your invitation has been dispatched. You will receive private access before seasonal harvests release.
            </p>
        </div>
    @else
        <form wire:submit="subscribe" class="space-y-2">
            <div class="flex flex-col sm:flex-row gap-2">
                <input
                    wire:model="email"
                    type="email"
                    placeholder="Enter your email address..."
                    required
                    aria-label="Email address for private harvest allocations"
                    class="flex-1 rounded-full border border-hairline bg-surface-card px-5 py-3 text-ui text-primary placeholder:text-muted focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition duration-250 {{ $errors->has('email') ? 'border-saffron ring-1 ring-saffron bg-saffron-surface/20' : '' }}"
                >

                <x-button
                    type="submit"
                    variant="primary"
                    size="md"
                    trailing-arrow
                    wire:loading.attr="disabled"
                    class="flex-shrink-0"
                >
                    <span wire:loading.remove wire:target="subscribe">Join Inner Circle</span>
                    <span wire:loading wire:target="subscribe" class="inline-flex items-center gap-2">
                        <x-spinner size="sm" color="white" />
                        <span>Enrolling...</span>
                    </span>
                </x-button>
            </div>

            @error('email')
                <p role="alert" class="text-caption text-saffron font-medium ml-4">
                    {{ $message }}
                </p>
            @enderror

            <p class="text-[11px] text-secondary ml-4">
                We honor your quiet time. Zero spam; private seasonal allocation notices only.
            </p>
        </form>
    @endif
</div>
