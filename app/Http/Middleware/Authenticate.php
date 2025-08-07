<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        // Only redirect if the request expects a full response (not JSON)
        if (! $request->expectsJson()) {
            $ssoLoginUrl = config('services.passport.login_url');
            $redirectBackTo = $request->fullUrl();

            return $ssoLoginUrl . '?redirect=' . urlencode($redirectBackTo);
        }

        return null;
    }
}
