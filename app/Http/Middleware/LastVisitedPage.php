<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LastVisitedPage
{
    public function handle(Request $request, Closure $next)
    {
        // If user is not logged in and not accessing the login page, store current URL in session
        if (!Auth::check() && !$request->is('login') && !$request->is('register')) {
            session(['url.intended' => $request->url()]);
        }

        return $next($request);
    }
}
