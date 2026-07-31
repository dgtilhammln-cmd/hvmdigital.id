<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPackage;
use Illuminate\Http\Request;

class PricingPackageController extends Controller
{
    public function index()
    {
        $packages = PricingPackage::orderBy('order')->get();
        return view('admin.pricing_packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.pricing_packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'features'    => 'nullable|array',
            'is_popular'  => 'boolean',
            'button_text' => 'required|string|max:255',
            'wa_message'  => 'nullable|string',
            'theme_style' => 'required|in:starter,professional,enterprise,custom',
            'order'       => 'required|integer',
        ]);

        $validated['is_popular'] = $request->has('is_popular');
        
        // Ensure features is clean
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], fn($v) => !empty($v));
            $validated['features'] = array_values($validated['features']); // re-index
        }

        PricingPackage::create($validated);

        return redirect()->route('admin.pricing_packages.index')->with('success', 'Paket harga berhasil ditambahkan.');
    }

    public function edit(PricingPackage $pricingPackage)
    {
        return view('admin.pricing_packages.edit', compact('pricingPackage'));
    }

    public function update(Request $request, PricingPackage $pricingPackage)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'features'    => 'nullable|array',
            'is_popular'  => 'boolean',
            'button_text' => 'required|string|max:255',
            'wa_message'  => 'nullable|string',
            'theme_style' => 'required|in:starter,professional,enterprise,custom',
            'order'       => 'required|integer',
        ]);

        $validated['is_popular'] = $request->has('is_popular');

        // Ensure features is clean
        if (isset($validated['features'])) {
            $validated['features'] = array_filter($validated['features'], fn($v) => !empty($v));
            $validated['features'] = array_values($validated['features']); // re-index
        } else {
            $validated['features'] = [];
        }

        $pricingPackage->update($validated);

        return redirect()->route('admin.pricing_packages.index')->with('success', 'Paket harga berhasil diperbarui.');
    }

    public function destroy(PricingPackage $pricingPackage)
    {
        $pricingPackage->delete();
        return redirect()->route('admin.pricing_packages.index')->with('success', 'Paket harga berhasil dihapus.');
    }
}
