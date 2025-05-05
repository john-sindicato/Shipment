<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if admin is logged in
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
