<?php

namespace App\Services;

use App\Models\Visitor;
use App\Models\WaClick;
use Illuminate\Http\Request;

class TrackingService
{
    public function recordVisitor(Request $request): void
    {
        try {
            Visitor::create([
                'session_id'  => $request->session()->getId(),
                'ip_address'  => $request->ip(),
                'page_url'    => $request->input('page_url', ''),
                'page_title'  => $request->input('page_title'),
                'referer'     => $request->input('referer'),
                'user_agent'  => $request->userAgent(),
                'device_type' => $this->detectDevice($request->userAgent() ?? ''),
                'browser'     => $this->detectBrowser($request->userAgent() ?? ''),
            ]);
        } catch (\Throwable) {
            // Non-blocking — never let tracking crash the app
        }
    }

    public function recordWaClick(Request $request): void
    {
        try {
            WaClick::create([
                'page_url'   => $request->input('page_url', ''),
                'page_title' => $request->input('page_title'),
                'ip_address' => $request->ip(),
                'source'     => $request->input('source', 'unknown'),
                'city'       => $request->input('city'),
            ]);
        } catch (\Throwable) {
            // Non-blocking
        }
    }

    private function detectDevice(string $ua): string
    {
        $ua = strtolower($ua);
        if (str_contains($ua, 'mobile') || str_contains($ua, 'android') || str_contains($ua, 'iphone')) {
            return 'mobile';
        }
        if (str_contains($ua, 'tablet') || str_contains($ua, 'ipad')) {
            return 'tablet';
        }
        return 'desktop';
    }

    private function detectBrowser(string $ua): string
    {
        return match (true) {
            str_contains($ua, 'Chrome')  => 'Chrome',
            str_contains($ua, 'Firefox') => 'Firefox',
            str_contains($ua, 'Safari')  => 'Safari',
            str_contains($ua, 'Edge')    => 'Edge',
            str_contains($ua, 'Opera')   => 'Opera',
            default                      => 'Other',
        };
    }
}
