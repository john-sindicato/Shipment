<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TellerAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if teller session exists
        if (!session()->has('teller_email')) {
            // Redirect to login if not authenticated
            return redirect()->route('teller.login')->with('error', 'Please log in first.');
        }

        return $next($request);
    }
}
