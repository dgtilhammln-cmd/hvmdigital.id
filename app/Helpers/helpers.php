<?php

if (!function_exists('setting')) {
    /**
     * Get a setting value from the database by key.
     */
    function setting(string $key, mixed $default = null): mixed
    {
        static $cache = [];

        if (!isset($cache[$key])) {
            try {
                $cache[$key] = \App\Models\Setting::get($key, $default);
            } catch (\Throwable $e) {
                return $default;
            }
        }

        return $cache[$key] ?? $default;
    }
}

if (!function_exists('hvm')) {
    /**
     * Get HVM company config value.
     */
    function hvm(string $key, mixed $default = null): mixed
    {
        return config('hvm.' . $key, $default);
    }
}

if (!function_exists('wa_link')) {
    /**
     * Generate WhatsApp chat URL with optional message.
     */
    function wa_link(?string $message = null): string
    {
        $message = addslashes($message ?? '');
        return "javascript:triggerLeadPopup('{$message}')";
    }
}

if (!function_exists('format_rupiah')) {
    function format_rupiah(int|float $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('get_image_url')) {
    /**
     * Get the correct URL for an image path.
     */
    function get_image_url(?string $path): string
    {
        if (empty($path)) {
            return '';
        }
        
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'images/')) {
            return asset($path);
        }

        return \Illuminate\Support\Facades\Storage::url($path);
    }
}
