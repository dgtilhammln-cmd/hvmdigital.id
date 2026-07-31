<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lead;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'company' => 'nullable|string|max:255',
            'needs' => 'required|string|max:1000',
            'source_url' => 'nullable|string|max:1000',
        ]);

        Lead::create($validated);

        // Build WhatsApp URL
        $waNumber = setting('whatsapp', '6285179982373');
        
        $message = "Halo HVM Digital,\n\n";
        $message .= "Perkenalkan, saya *{$validated['name']}*";
        if (!empty($validated['company'])) {
            $message .= " dari *{$validated['company']}*";
        }
        $message .= ".\n\n";
        $message .= "Saya ingin konsultasi mengenai:\n_{$validated['needs']}_\n\n";
        if (!empty($validated['source_url'])) {
            $message .= "Sumber: {$validated['source_url']}\n";
        }
        $message .= "Mohon info lebih lanjut. Terima kasih!";

        $waUrl = 'https://wa.me/' . $waNumber . '?text=' . urlencode($message);

        return response()->json([
            'status' => 'success',
            'message' => 'Data tersimpan.',
            'redirect_url' => $waUrl
        ]);
    }
}
