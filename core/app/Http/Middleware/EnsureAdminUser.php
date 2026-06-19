<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if ((int) $request->user()->user_type !== 1) {
            return redirect()->route('crmdashboard');
        }

        return $next($request);
    }
}