<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            // Redirect based on URL pattern or guard
            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            return route('user.login');
        }

        return null;
    }
}
