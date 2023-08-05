<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Check if the user is not verified (email_verified_at is null)
            if (is_null(auth()->user()->email_verified_at)) {
                return $next($request); // User is not verified, allow access to the /email/verify route
            } else {
                return redirect('/'); // User is already verified, redirect to the home page or any other page you want
            }
        }

        return $next($request);
    }
}