<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component
{
    /**
     * Handle an incoming authentication request.
     */
    public function loginWithSSO(): void
    {
        $ssoLoginUrl = config('services.passport.login_url');
        $redirectBackTo = route('sso.callback');

        redirect()->away($ssoLoginUrl . '?redirect=' . urlencode($redirectBackTo));
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('Log in to your account')"
        :description="__('You will be redirected to the authentication server.')"
    />

    <form wire:submit="loginWithSSO" class="flex flex-col gap-6">
        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">
                {{ __('Log in with SSO') }}
            </flux:button>
        </div>
    </form>
</div>
