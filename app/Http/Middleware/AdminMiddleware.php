<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    private const ALLOWED_EMAIL = 'k.raghay@cdg-cgpark.com';

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('admin_authenticated')) {
            return redirect()->route('console.login');
        }

        if ($request->session()->get('admin_email') !== self::ALLOWED_EMAIL) {
            $request->session()->forget(['admin_authenticated', 'admin_email']);
            return redirect()->route('console.login')->withErrors(['email' => 'Accès non autorisé.']);
        }

        return $next($request);
    }
}
