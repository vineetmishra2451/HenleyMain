<?php

declare(strict_types=1);

namespace App\Livewire\Storefront;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class NewsletterSignup extends Component
{
    #[Validate('required|email|max:255')]
    public string $email = '';

    public bool $subscribed = false;

    public function subscribe(): void
    {
        $this->validate();

        // In a real subscriber table or mailing service:
        Log::info("Newsletter subscription received for: {$this->email}");

        $this->subscribed = true;
        $this->email = '';
    }

    public function render(): View
    {
        return view('livewire.storefront.newsletter-signup');
    }
}
