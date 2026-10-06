<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('main')->with('error', 'Доступ только для администраторов.');
        }

        return $next($request);
    }
}