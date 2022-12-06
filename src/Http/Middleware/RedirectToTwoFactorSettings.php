<?php

namespace CloudMazing\FilamentForce2FA\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webbingbrasil\FilamentTwoFactor\FilamentTwoFactor;
use Webbingbrasil\FilamentTwoFactor\Pages\TwoFactor;

class RedirectToTwoFactorSettings
{
    public function handle(Request $request, Closure $next)
    {
        if (config('app.env') === 'local') {
            return $next($request);
        }

        // Route for 2FA config
        $twoFactorConfigRoute = TwoFactor::getRouteName();
        $skipRoutes = [TwoFactor::getRouteName(), 'logout'];

        $user = Auth::check() ? Auth::user() : null;
        $twoFactorIsDisabled = !app(FilamentTwoFactor::class)->hasTwoFactorEnabled($request->user());
        $currentRouteIsNotTwoFactorConfigRoute = !$request->routeIs($skipRoutes);

        // User should be redirected to 2FA config if;
        // - user is logged in
        // - user has two-factor disabled
        // - requested route != 2FA config
        $shouldRedirect = $user
            && $twoFactorIsDisabled
            && $currentRouteIsNotTwoFactorConfigRoute;

        if ($shouldRedirect) {
            return redirect()->route($twoFactorConfigRoute);
        }

        return $next($request);
    }
}
