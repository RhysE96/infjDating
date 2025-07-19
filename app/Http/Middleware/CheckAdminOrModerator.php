<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * This middleware checks if the authenticated user is an admin or moderator.
 * If not, it aborts with a 403 Forbidden response.
 */

class CheckAdminOrModerator
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (! $user || ! in_array($user->role, ['admin', 'moderator'])) {
            abort(403);
        }

        return $next($request);
    }
}