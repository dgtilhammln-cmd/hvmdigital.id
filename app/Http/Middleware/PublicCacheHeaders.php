<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware untuk mengatur Cache-Control headers pada halaman publik.
 * 
 * Halaman publik (bukan admin, bukan API) akan mendapat header:
 *   Cache-Control: public, max-age=300, s-maxage=3600
 * 
 * Ini penting agar Googlebot bisa caching halaman dan tidak menganggap
 * halaman "transient" sehingga menolak mengindeksnya.
 */
class PublicCacheHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya set cache untuk halaman publik yang sukses (200 OK)
        if ($response->getStatusCode() !== 200) {
            return $response;
        }

        // Jangan cache halaman admin, login, atau JSON API
        $path = $request->path();
        if (
            str_starts_with($path, 'admin') ||
            str_starts_with($path, 'login') ||
            str_starts_with($path, 'api') ||
            str_starts_with($path, 'track') ||
            $request->expectsJson()
        ) {
            return $response;
        }

        // Jangan override jika response sudah set cache secara eksplisit
        $contentType = $response->headers->get('Content-Type', '');
        if (str_contains($contentType, 'text/html') || str_contains($contentType, 'application/xml')) {
            $response->headers->set('Cache-Control', 'public, max-age=300, s-maxage=3600');
            $response->headers->remove('Pragma');
        }

        return $response;
    }
}
