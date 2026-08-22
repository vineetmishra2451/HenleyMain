<div class="space-y-6">
    <div class="text-center">
        <h2 class="font-serif text-3xl font-normal text-primary tracking-tight">Set New Password</h2>
        <p class="mt-2 text-sm text-secondary">Choose a strong passphrase with at least 12 characters.</p>
    </div>

    <form wire:submit="resetPassword" class="space-y-4">
        <x-form.input
            wire:model="email"
            name="email"
            type="email"
            label="Email Address"
            :error="$errors->first('email')"
            required
        />

        <x-form.input
            wire:model="password"
            name="password"
            type="password"
            label="New Password"
            hint="Minimum 12 characters with letters, numbers & symbols"
            :error="$errors->first('password')"
            required
        />

        <x-form.input
            wire:model="password_confirmation"
            name="password_confirmation"
            type="password"
            label="Confirm New Password"
            :error="$errors->first('password_confirmation')"
            required
        />

        <div class="pt-2">
            <x-button
                type="submit"
                variant="primary"
                class="w-full"
                wire:loading.attr="disabled"
                trailing-arrow
            >
                <span wire:loading.remove wire:target="resetPassword">Update Password</span>
                <span wire:loading wire:target="resetPassword" class="inline-flex items-center gap-2">
                    <x-spinner size="sm" color="white" />
                    <span>Updating...</span>
                </span>
            </x-button>
        </div>
    </form>
</div>
