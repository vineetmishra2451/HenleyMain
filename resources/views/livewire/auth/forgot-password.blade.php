<div class="space-y-6">
    <div class="text-center">
        <h2 class="font-serif text-3xl font-normal text-primary tracking-tight">Recover Password</h2>
        <p class="mt-2 text-sm text-secondary">Enter your email and we will dispatch a secure restoration link.</p>
    </div>

    @if (session('status'))
        <x-alert tone="success">
            {{ session('status') }}
        </x-alert>
    @endif

    <form wire:submit="sendResetLink" class="space-y-5">
        <x-form.input
            wire:model="email"
            name="email"
            type="email"
            label="Email Address"
            placeholder="collector@henleytea.com"
            :error="$errors->first('email')"
            required
        />

        <x-button
            type="submit"
            variant="primary"
            class="w-full"
            wire:loading.attr="disabled"
            trailing-arrow
        >
            <span wire:loading.remove wire:target="sendResetLink">Send Recovery Link</span>
            <span wire:loading wire:target="sendResetLink" class="inline-flex items-center gap-2">
                <x-spinner size="sm" color="white" />
                <span>Dispatching...</span>
            </span>
        </x-button>
    </form>

    <div class="mt-8 pt-6 border-t border-hairline text-center">
        <p class="text-xs text-secondary">
            Remembered your password?
            <a href="{{ route('login') }}" class="font-medium text-accent hover:underline underline-offset-4 ml-1">
                Return to sign in
            </a>
        </p>
    </div>
</div>
