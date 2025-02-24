<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // ตรวจสอบว่า role ของผู้ใช้ตรงกับสิทธิ์ที่กำหนดหรือไม่
        if (auth()->user()->role !== $role) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
