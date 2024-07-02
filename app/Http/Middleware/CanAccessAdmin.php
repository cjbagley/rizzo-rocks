<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanAccessAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (empty(config('auth.admin_token'))) {
            return redirect('/');
        }

        if (! Auth::check()) {
            return redirect('/');
        }

        if (empty(Auth::user()->admin_token)) {
            return redirect('/');
        }

        try {
            if (! Hash::check(config('auth.admin_token'), Auth::user()->admin_token)) {
                return redirect('/');
            }
        } catch (\Exception) {
            return redirect('/');
        }

        return $next($request);
    }
}
