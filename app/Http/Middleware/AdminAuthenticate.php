<?php

namespace App\Http\Middleware; // Yeh line bilkul sahi honi chahiye

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        return redirect()->route('admin.login');
    }

    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            
            // This is the new logic:
            // If the route they are trying to access is an admin route...
            if ($request->routeIs('admin.*')) {
                // ...redirect them to the admin login page.
                return route('admin.login');
            }

            // Otherwise, for all other routes, redirect to the normal user login page.
            return route('login');
        }
        return null; // For API requests, return null
    }
}