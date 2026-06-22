<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCrmUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if ((int) $request->user()->user_type === 1) {
            return redirect()->route('clientlist');
        }

        if ((int) $request->user()->user_type !== 2) {
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}