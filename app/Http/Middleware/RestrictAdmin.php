<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if (auth()->guest() || (auth()->check() && $user->user_type != 'admin') && ($user->add_info_completed == true && $user->survey_completed == true && $user->email_verified_at)) {
            return $next($request);
        }
        return redirect('/');
    }
}