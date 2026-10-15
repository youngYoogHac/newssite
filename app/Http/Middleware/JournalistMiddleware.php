<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JournalistMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (! $user || ! in_array($user->role?->name, ['journalist', 'admin'], true)) {
            return redirect()
                ->route('main')
                ->with('error', 'Нужны права журналиста.');
        }

        return $next($request);
    }
}