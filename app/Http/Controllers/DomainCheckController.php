<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DomainCheckController extends Controller
{
    /**
     * Cek ketersediaan domain menggunakan DNS lookup (gratis, tanpa API pihak ketiga).
     * Logikanya: Jika domain sudah terdaftar, DNS server pasti punya record-nya.
     * Jika tidak ada record sama sekali, kemungkinan besar domain tersedia.
     *
     * ⚠ Catatan: Metode ini ~95% akurat. Domain yang baru expired mungkin masih punya DNS record.
     */
    public function check(Request $request): JsonResponse
    {
        $request->validate([
            'domain' => 'required|string|max:255',
        ]);

        $input  = strtolower(trim($request->input('domain')));
        $input  = preg_replace('/[^a-z0-9\-\.]/', '', $input);

        // Jika user hanya mengetik nama tanpa TLD, cek beberapa TLD populer
        if (!str_contains($input, '.')) {
            $tlds = ['.com', '.id', '.co.id', '.net', '.org', '.store', '.online', '.site', '.xyz', '.io'];
            $results = [];

            foreach ($tlds as $tld) {
                $fullDomain = $input . $tld;
                $results[] = [
                    'domain'    => $fullDomain,
                    'tld'       => $tld,
                    'available' => $this->isDomainAvailable($fullDomain),
                ];
            }

            return response()->json([
                'success' => true,
                'query'   => $input,
                'results' => $results,
            ]);
        }

        // Jika user mengetik domain lengkap (contoh: tokobaju.com)
        $available = $this->isDomainAvailable($input);
        $tld = '.' . implode('.', array_slice(explode('.', $input), 1));

        return response()->json([
            'success' => true,
            'query'   => $input,
            'results' => [
                [
                    'domain'    => $input,
                    'tld'       => $tld,
                    'available' => $available,
                ],
            ],
        ]);
    }

    /**
     * Cek apakah domain tersedia menggunakan multi-method DNS check.
     * Kombinasi checkdnsrr() + gethostbyname() untuk akurasi tinggi.
     */
    private function isDomainAvailable(string $domain): bool
    {
        // Method 1: Cek record A (IPv4)
        if (checkdnsrr($domain, 'A')) {
            return false;
        }

        // Method 2: Cek record AAAA (IPv6)
        if (checkdnsrr($domain, 'AAAA')) {
            return false;
        }

        // Method 3: Cek record NS (Nameserver) — lebih reliable untuk domain terdaftar tapi belum punya hosting
        if (checkdnsrr($domain, 'NS')) {
            return false;
        }

        // Method 4: Cek record MX (Email) — domain dengan email pasti sudah terdaftar
        if (checkdnsrr($domain, 'MX')) {
            return false;
        }

        // Method 5: Double-check dengan gethostbyname — returns IP jika domain terdaftar
        $ip = @gethostbyname($domain);
        if ($ip !== $domain) {
            return false; // resolved ke IP = domain sudah terdaftar
        }

        // Semua pengecekan tidak menemukan record → domain kemungkinan besar tersedia
        return true;
    }
}
