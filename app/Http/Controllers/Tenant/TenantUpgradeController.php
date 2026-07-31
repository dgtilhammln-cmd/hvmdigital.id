<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TenantUpgradeController extends Controller
{
    /**
     * Domain Base Prices (before markup)
     */
    private $basePrices = [
        'com' => 150000,
        'id'  => 250000,
        'net' => 175000,
        'org' => 180000,
        'co.id' => 300000,
        'my.id' => 15000,
        'biz.id' => 20000,
        'sch.id' => 60000,
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
     * Check Domain Availability & Return Prices
     */
    public function checkDomain(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:3',
        ]);

        $query = Str::lower($request->input('query'));
        // Remove spaces and special chars, except hyphen and dot
        $query = preg_replace('/[^a-z0-9\-\.]/', '', $query);

        // Extract name and tld if provided
        $parts = explode('.', $query, 2);
        $name = $parts[0];
        $inputTld = isset($parts[1]) ? $parts[1] : null;

        $results = [];

        // If they provided a specific TLD, check only that, otherwise check popular ones
        $tldsToCheck = $inputTld ? [$inputTld] : ['com', 'id', 'net', 'my.id', 'co.id'];

        foreach ($tldsToCheck as $tld) {
            if (!isset($this->basePrices[$tld])) {
                continue; // Skip unsupported TLDs for now
            }

            $domain = $name . '.' . $tld;
            
            // Check availability using DNS (true if exists -> not available)
            // Note: This is a fast, free estimation. checkdnsrr returns true if ANY record exists.
            $isRegistered = checkdnsrr($domain, 'ANY');
            $isAvailable = !$isRegistered;

            // Calculate Price
            $basePrice = $this->basePrices[$tld];
            $markupPrice = $basePrice * 2;
            $adminFee = 10000;
            $subTotal = $markupPrice + $adminFee;
            $tax = $subTotal * 0.11; // 11% tax
            $totalPrice = $subTotal + $tax;

            $results[] = [
                'domain' => $domain,
                'available' => $isAvailable,
                'tld' => $tld,
                'price' => [
                    'base' => $basePrice,
                    'markup' => $markupPrice,
                    'admin_fee' => $adminFee,
                    'tax' => $tax,
                    'total' => $totalPrice,
                    'total_formatted' => 'Rp ' . number_format($totalPrice, 0, ',', '.'),
                ]
            ];
        }

        return response()->json([
            'success' => true,
            'results' => $results,
        ]);
    }
}
