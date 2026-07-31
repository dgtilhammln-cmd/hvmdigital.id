<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Setting;

class TenantUpgradeController extends Controller
{
    /**
     * Domain Base Prices (before markup)
     * Source: approximate registry prices in IDR
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
     * Show Upgrade Wizard
     */
    public function index()
    {
        $tenant = Auth::user()->tenant;
        return view('tenant.dashboard.upgrade', compact('tenant'));
    }

    /**
     * Check Domain Availability via WhoisJSON.com API
     * Pricing: (base * 2) + 10_000 admin fee + 11% PPN
     */
    public function checkDomain(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2',
        ]);

        $raw   = Str::lower(trim($request->input('query')));
        // Strip protocol/www if user pastes full URL
        $raw   = preg_replace('#^https?://(www\.)?#', '', $raw);
        // Only allow safe chars
        $raw   = preg_replace('/[^a-z0-9\-\.]/', '', $raw);

        // Split name and optional TLD
        $parts    = explode('.', $raw, 2);
        $name     = $parts[0];
        $inputTld = isset($parts[1]) && $parts[1] !== '' ? $parts[1] : null;

        $tldsToCheck = $inputTld ? [$inputTld] : ['com', 'id', 'net', 'my.id', 'co.id'];

        // Get WhoisJSON API key from settings
        $apiKey = Setting::where('key', 'whoisjson_api_key')->value('value');

        $results = [];

        foreach ($tldsToCheck as $tld) {
            if (!isset($this->basePrices[$tld])) {
                continue;
            }

            $domain    = $name . '.' . $tld;
            $isAvailable = $this->checkViaWhoisJson($domain, $apiKey);

            // Pricing formula: (base * 2) + 10_000 + 11% PPN
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
            'results' => $results,
        ]);
    }

    /**
     * Check domain availability using WhoisJSON.com API.
     * Returns true if domain is available, false if taken.
     */
    private function checkViaWhoisJson(string $domain, ?string $apiKey): bool
    {
        try {
            $headers = ['Accept' => 'application/json'];
            if (!empty($apiKey)) {
                $headers['Authorization'] = 'Token ' . $apiKey;
            }

            $response = Http::withHeaders($headers)
                ->timeout(8)
                ->get('https://whoisjson.com/api/v1/whois', [
                    'domain' => $domain,
                ]);

            if (!$response->successful()) {
                // On error, fallback to DNS check
                return $this->fallbackDnsCheck($domain);
            }

            $data = $response->json();

            // WhoisJSON returns `status` array or `registered` boolean
            // If domain has a registrar or creation date it's taken
            if (!empty($data['domain']) && !empty($data['registrar'])) {
                return false; // taken
            }

            if (isset($data['registered'])) {
                return !$data['registered'];
            }

            // If WhoisJSON can't find WHOIS data, domain is likely available
            if (isset($data['error']) || empty($data['domain'])) {
                return true; // assume available
            }

            return false;

        } catch (\Throwable $e) {
            // Fallback on exception
            return $this->fallbackDnsCheck($domain);
        }
    }

    /**
     * Fallback: DNS check (free, less accurate but always available)
     */
    private function fallbackDnsCheck(string $domain): bool
    {
        return !checkdnsrr($domain, 'ANY');
    }
}
