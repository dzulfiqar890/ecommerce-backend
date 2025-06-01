<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized. Silakan login.'], 401);
        }

        $user = auth()->user();

        // Hanya izinkan jika role adalah 'customer' saja
        if ($user->role !== 'customer') {
            return response()->json(['error' => 'Akses ditolak. Khusus pelanggan (customer).'], 403);
        }

        return $next($request);
    }
}
