<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DomainCheckController extends Controller
{
    /**
     * Domain Base Prices (before markup)
     */
    private $basePrices = [
        'com'   => 150000,
        'id'    => 250000,
        'net'   => 175000,
        'org'   => 180000,
        'co.id' => 300000,
        'my.id' => 15000,
        'biz.id'=> 20000,
        'sch.id'=> 60000,
    ];

    /**
     * Cek ketersediaan domain dan hitung harga (API + Markup)
     */
    public function check(Request $request): JsonResponse
    {
        $request->validate([
            'domain' => 'required|string|min:2', // Frontend sends 'domain' in onboarding
        ]);

        $raw   = \Illuminate\Support\Str::lower(trim($request->input('domain')));
        $raw   = preg_replace('#^https?://(www\.)?#', '', $raw);
        $raw   = preg_replace('/[^a-z0-9\-\.]/', '', $raw);

        $parts    = explode('.', $raw, 2);
        $name     = $parts[0];
        $inputTld = isset($parts[1]) && $parts[1] !== '' ? $parts[1] : null;

        $tldsToCheck = $inputTld ? [$inputTld] : ['com', 'id', 'net', 'my.id', 'co.id'];
        $apiKey = \App\Models\Setting::where('key', 'whoisjson_api_key')->value('value');

        $results = [];

        foreach ($tldsToCheck as $tld) {
            if (!isset($this->basePrices[$tld])) {
                continue;
            }

            $domain    = $name . '.' . $tld;
            $isAvailable = $this->checkViaWhoisJson($domain, $apiKey);

            $basePrice  = $this->basePrices[$tld];
            $markup     = $basePrice * 2;
            $adminFee   = 10000;
            $subTotal   = $markup + $adminFee;
            $tax        = round($subTotal * 0.11);
            $total      = $subTotal + $tax;

            $results[] = [
                'domain'    => $domain,
                'available' => $isAvailable,
                'tld'       => $tld,
                'price'     => [
                    'base'            => $basePrice,
                    'markup'          => $markup,
                    'admin_fee'       => $adminFee,
                    'tax'             => $tax,
                    'total'           => $total,
                    'total_formatted' => 'Rp ' . number_format($total, 0, ',', '.'),
                ],
            ];
        }

        return response()->json([
            'success' => true,
            'query'   => $raw,
            'results' => $results,
        ]);
    }

    private function checkViaWhoisJson(string $domain, ?string $apiKey): bool
    {
        try {
            $headers = ['Accept' => 'application/json'];
            if (!empty($apiKey)) {
                $headers['Authorization'] = 'TOKEN=' . $apiKey;
            }

            $response = \Illuminate\Support\Facades\Http::withHeaders($headers)
                ->timeout(10)
                ->get('https://whoisjson.com/api/v1/whois/', [
                    'domain' => $domain,
                ]);

            if (!$response->successful()) return $this->fallbackDnsCheck($domain);

            $data = $response->json();
            $registrarName = $data['registrar']['name'] ?? null;
            $createdDate   = $data['created_date'] ?? $data['creation_date'] ?? null;

            if (!empty($registrarName) || !empty($createdDate)) return false;

            return true;
        } catch (\Throwable $e) {
            return $this->fallbackDnsCheck($domain);
        }
    }

    private function fallbackDnsCheck(string $domain): bool
    {
        return !checkdnsrr($domain, 'ANY');
    }
}
