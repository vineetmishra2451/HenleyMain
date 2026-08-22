<div>
    @if ($subscribed)
        <div class="rounded-xl border border-sage/30 bg-sage-surface/40 p-4 text-center">
            <div class="flex items-center justify-center gap-2 text-sage-text font-medium text-ui">
                <x-icons.check-circle class="w-5 h-5 text-sage" />
                <span>You are subscribed to the Collector Circle.</span>
            </div>
            <p class="mt-1 text-caption text-secondary">A confirmation dispatch has been routed to your inbox.</p>
        </div>
    @else
        <form wire:submit="subscribe" class="space-y-3">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5 max-w-md mx-auto">
                <div class="relative flex-1">
                    <input
                        type="email"
                        wire:model="email"
                        placeholder="collector@henleytea.com"
                        required
                        aria-label="Email address for newsletter"
                        class="w-full rounded-full border border-hairline bg-surface-card px-5 py-3 text-ui text-primary placeholder:text-muted focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition duration-250 {{ $errors->has('email') ? 'border-saffron ring-1 ring-saffron' : '' }}"
                    >
                </div>

                <x-button
                    type="submit"
                    variant="primary"
                    size="md"
                    trailing-arrow
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove wire:target="subscribe">Join Circle</span>
                    <span wire:loading wire:target="subscribe" class="inline-flex items-center gap-1.5">
                        <x-spinner size="sm" color="white" />
                        <span>Joining...</span>
                    </span>
                </x-button>
            </div>

            @error('email')
                <p role="alert" class="text-caption text-saffron text-center font-medium">{{ $message }}</p>
            @enderror

            <p class="text-[11px] text-muted text-center">
                Strictly botanical dispatches & rare allocation notifications. Zero commercial noise.
            </p>
        </form>
    @endif
</div>
