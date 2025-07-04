<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth('api')->user();
        if ($user && $user->role === 'admin') {
            return $next($request);
        }
        return response()->json(['error' => 'Forbidden. Admin only.'], 403);
    }
}