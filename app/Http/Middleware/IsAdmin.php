<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized. Silakan login.'], 401);
        }

        if ($request->user()->role !== 'admin') {
            return response()->json(['message' => 'Akses dibatasi hanya admin.'], 403);
        }

        return $next($request);
    }
}
