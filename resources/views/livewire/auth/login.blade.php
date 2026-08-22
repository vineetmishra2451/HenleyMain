<div class="space-y-6">
    <div class="text-center">
        <h2 class="font-serif text-3xl font-normal text-primary tracking-tight">Collector Access</h2>
        <p class="mt-2 text-sm text-secondary">Sign in to curate your personal tea and spice rituals.</p>
    </div>

    @if (session('status'))
        <x-alert tone="success">
            {{ session('status') }}
        </x-alert>
    @endif

    <form wire:submit="login" class="space-y-5">
        <x-form.input
            wire:model="email"
            name="email"
            type="email"
            label="Email Address"
            placeholder="collector@henleytea.com"
            :error="$errors->first('email')"
            required
        />

        <div class="space-y-1.5">
            <div class="flex items-center justify-between">
                <label for="password" class="block text-xs font-semibold uppercase tracking-[0.14em] text-primary">Password</label>
                <a href="{{ route('password.request') }}" class="text-xs text-secondary hover:text-accent transition-colors underline decoration-hairline underline-offset-4 hover:decoration-accent">
                    Forgot password?
                </a>
            </div>
            <input
                wire:model="password"
                type="password"
                id="password"
                required
                class="block w-full rounded-md border bg-surface-card px-4 py-2.5 text-ui text-primary shadow-none placeholder:text-muted focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent transition-colors duration-250 ease-henley {{ $errors->has('password') ? 'border-saffron ring-1 ring-saffron bg-saffron-surface/20' : 'border-hairline hover:border-muted' }}"
            >
            @error('password')
                <p role="alert" class="text-caption text-saffron font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <x-form.checkbox
                wire:model="remember"
                name="remember"
                label="Remember this device"
            />
        </div>

        <x-button
            type="submit"
            variant="primary"
            class="w-full"
            wire:loading.attr="disabled"
            trailing-arrow
        >
            <span wire:loading.remove wire:target="login">Enter Sanctuary</span>
            <span wire:loading wire:target="login" class="inline-flex items-center gap-2">
                <x-spinner size="sm" color="white" />
                <span>Authenticating...</span>
            </span>
        </x-button>

        @if (config('henley.auth.otp_enabled', true))
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-hairline"></div>
                </div>
                <div class="relative flex justify-center text-xs uppercase tracking-widest">
                    <span class="bg-surface-raised px-3 text-muted">Or</span>
                </div>
            </div>

            <x-link-button
                href="{{ route('login.otp') }}"
                variant="secondary"
                size="md"
                class="w-full"
            >
                Sign in with OTP Code
            </x-link-button>
        @endif
    </form>

    <div class="mt-8 pt-6 border-t border-hairline text-center">
        <p class="text-xs text-secondary">
            New to Henley?
            <a href="{{ route('register') }}" class="font-medium text-accent hover:underline underline-offset-4 ml-1">
                Create a Collector Account
            </a>
        </p>
    </div>
</div>
