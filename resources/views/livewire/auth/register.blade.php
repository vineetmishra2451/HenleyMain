<div class="space-y-6">
    <div class="text-center">
        <h2 class="font-serif text-3xl font-normal text-primary tracking-tight">Create Collector Profile</h2>
        <p class="mt-2 text-sm text-secondary">Join our inner circle for premier harvest allocations.</p>
    </div>

    <form wire:submit="register" class="space-y-4">
        <x-form.input
            wire:model="name"
            name="name"
            label="Full Name"
            placeholder="Margaret Henley"
            :error="$errors->first('name')"
            required
        />

        <x-form.input
            wire:model="email"
            name="email"
            type="email"
            label="Email Address"
            placeholder="collector@henleytea.com"
            :error="$errors->first('email')"
            required
        />

        <x-form.input
            wire:model="phone"
            name="phone"
            type="tel"
            label="Mobile Number (Optional)"
            placeholder="+91 98200 12345"
            hint="Used exclusively for harvest drops & delivery updates"
            :error="$errors->first('phone')"
        />

        <x-form.input
            wire:model="password"
            name="password"
            type="password"
            label="Password"
            hint="Minimum 12 characters with letters, numbers & symbols"
            :error="$errors->first('password')"
            required
        />

        <x-form.input
            wire:model="password_confirmation"
            name="password_confirmation"
            type="password"
            label="Confirm Password"
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
                <span wire:loading.remove wire:target="register">Complete Registration</span>
                <span wire:loading wire:target="register" class="inline-flex items-center gap-2">
                    <x-spinner size="sm" color="white" />
                    <span>Creating Profile...</span>
                </span>
            </x-button>
        </div>
    </form>

    <div class="mt-8 pt-6 border-t border-hairline text-center">
        <p class="text-xs text-secondary">
            Already registered?
            <a href="{{ route('login') }}" class="font-medium text-accent hover:underline underline-offset-4 ml-1">
                Sign in to your account
            </a>
        </p>
    </div>
</div>
