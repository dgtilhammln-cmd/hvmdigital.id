<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $userRole = session('admin_role', 'admin');

        // Jika tidak ada role spesifik yang diminta, boleh lanjut
        if (empty($roles)) {
            return $next($request);
        }

        // Admin selalu punya akses penuh, kecuali secara eksplisit dibatasi
        if ($userRole === 'admin') {
            return $next($request);
        }

        // Cek apakah role user ada di dalam daftar roles yang diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Redirect jika tidak punya akses
        return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
