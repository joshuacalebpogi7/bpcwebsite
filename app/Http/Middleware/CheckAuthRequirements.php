<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAuthRequirements
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        //the sequence is important. It will check first if survey is completed so the user can't skip the add_info.
        if (!$user) {
            return redirect('/')->with('reject', 'you must be logged in.');
        }
        if (!$user->survey_completed) {
            return redirect('/');
        }
        if ($user->survey_completed && $user->add_info_completed) {
            return redirect('/');
        }

        return $next($request);
    }
}