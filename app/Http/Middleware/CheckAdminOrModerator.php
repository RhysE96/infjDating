<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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