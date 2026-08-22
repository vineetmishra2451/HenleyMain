<div class="space-y-6">
    <div class="text-center">
        <h2 class="font-serif text-3xl font-normal text-primary tracking-tight">Verify Your Email</h2>
        <p class="mt-2 text-sm text-secondary">
            Before proceeding, please verify your email address by clicking on the link we just emailed to you.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <x-alert tone="success">
            A new verification link has been sent to the email address you provided during registration.
        </x-alert>
    @endif

    <div class="space-y-4 pt-2">
        <x-button
            wire:click="resendVerification"
            variant="primary"
            class="w-full"
            wire:loading.attr="disabled"
            trailing-arrow
        >
            <span wire:loading.remove wire:target="resendVerification">Resend Verification Email</span>
            <span wire:loading wire:target="resendVerification" class="inline-flex items-center gap-2">
                <x-spinner size="sm" color="white" />
                <span>Sending...</span>
            </span>
        </x-button>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-button
                type="submit"
                variant="secondary"
                class="w-full"
            >
                Sign Out
            </x-button>
        </form>
    </div>
</div>
