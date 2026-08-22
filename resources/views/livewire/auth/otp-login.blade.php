<div class="space-y-6">
    <div class="text-center">
        <h2 class="font-serif text-3xl font-normal text-primary tracking-tight">Single-Use Code Access</h2>
        <p class="mt-2 text-sm text-secondary">Sign in quickly using a 6-digit authentication code sent via SMS.</p>
    </div>

    @if (session('status'))
        <x-alert tone="success">
            {{ session('status') }}
        </x-alert>
    @endif

    <div>
        @if (! $codeSent)
            <form wire:submit="requestOtp" class="space-y-5">
                <x-form.input
                    wire:model="phone"
                    name="phone"
                    type="tel"
                    label="Mobile Phone Number"
                    placeholder="+91 98200 12345"
                    hint="Enter your 10-digit Indian phone number"
                    :error="$errors->first('phone')"
                    required
                />

                <x-button
                    type="submit"
                    variant="primary"
                    class="w-full"
                    wire:loading.attr="disabled"
                    trailing-arrow
                >
                    <span wire:loading.remove wire:target="requestOtp">Send 6-Digit Code</span>
                    <span wire:loading wire:target="requestOtp" class="inline-flex items-center gap-2">
                        <x-spinner size="sm" color="white" />
                        <span>Sending SMS...</span>
                    </span>
                </x-button>
            </form>
        @else
            <form wire:submit="verifyOtp" class="space-y-5">
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="code" class="block text-xs font-semibold uppercase tracking-[0.14em] text-primary">6-Digit Code</label>
                        <button type="button" wire:click="resendCode" class="text-xs text-secondary hover:text-accent transition-colors underline decoration-hairline underline-offset-4 hover:decoration-accent">
                            Resend code
                        </button>
                    </div>
                    <input
                        wire:model="code"
                        type="text"
                        id="code"
                        placeholder="••••••"
                        maxlength="6"
                        required
                        class="block w-full rounded-md border bg-surface-card px-4 py-3 text-center tracking-[0.5em] font-mono text-xl text-primary shadow-none placeholder:text-muted focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition-colors duration-250 ease-henley {{ $errors->has('code') ? 'border-saffron ring-1 ring-saffron bg-saffron-surface/20' : 'border-hairline hover:border-muted' }}"
                    >
                    @error('code')
                        <p role="alert" class="text-caption text-saffron font-medium text-center">{{ $message }}</p>
                    @enderror
                </div>

                <x-button
                    type="submit"
                    variant="primary"
                    class="w-full"
                    wire:loading.attr="disabled"
                    trailing-arrow
                >
                    <span wire:loading.remove wire:target="verifyOtp">Verify & Sign In</span>
                    <span wire:loading wire:target="verifyOtp" class="inline-flex items-center gap-2">
                        <x-spinner size="sm" color="white" />
                        <span>Verifying...</span>
                    </span>
                </x-button>
            </form>
        @endif
    </div>

    <div class="mt-8 pt-6 border-t border-hairline text-center">
        <p class="text-xs text-secondary">
            Prefer email and password?
            <a href="{{ route('login') }}" class="font-medium text-accent hover:underline underline-offset-4 ml-1">
                Password Login
            </a>
        </p>
    </div>
</div>
