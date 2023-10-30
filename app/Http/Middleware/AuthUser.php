<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ((auth()->check() && $user->user_type == 'alumni') && isset($user->email_verified_at) && ($user->add_info_completed == true && $user->survey_completed == true)) {
            return $next($request);
        }
        return redirect('/');
    }
}