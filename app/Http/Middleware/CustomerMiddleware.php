<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = auth()->user();

        // Izinkan akses jika peran adalah 'admin' atau 'customer'
        if (in_array($user->role, ['admin', 'customer'])) {
            return $next($request);
        }

        // Jika bukan admin atau customer, tolak akses
        return response()->json(['error' => 'Akses ditolak. Anda bukan admin atau customer.'], 403);
        // Alternatif: redirect()->route('home')->with('error', 'Akses ditolak.');
    }
}
