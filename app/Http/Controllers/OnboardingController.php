<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OnboardingController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $tenant = $user->tenant;

        if (!$tenant) {
            $tenant = Tenant::create([
                'user_id'       => $user->id,
                'business_name' => $user->name . "'s Business",
                'slug'          => Str::slug($user->name) . '-' . Str::random(4),
                'status'        => 'onboarding',
                'onboarding_step' => 1,
            ]);
        }

        // If already active, redirect to tenant dashboard
        if ($tenant->status === 'active') {
            if (empty($tenant->plan)) {
                // Fix for users stuck in active status without choosing a domain/plan
                $tenant->update(['status' => 'onboarding', 'onboarding_step' => 2]);
                $tenant->refresh();
            } else {
                return redirect()->route('tenant.dashboard');
            }
        }

        return view('onboarding.index', compact('tenant'));
    }

    /**
     * Save Step 1: Profil Usaha
     */
    public function saveProfile(Request $request)
    {
        $validated = $request->validate([
            'business_name'     => 'required|string|max:255',
            'business_type'     => 'required|string|max:100',
            'business_category' => 'nullable|string|max:100',
            'description'       => 'nullable|string|max:1000',
            'phone'             => 'nullable|string|max:20',
            'whatsapp'          => 'required|string|max:20',
            'email_business'    => 'nullable|email|max:255',
            'address'           => 'required|string|max:500',
            'city'              => 'required|string|max:100',
            'province'          => 'nullable|string|max:100',
            'postal_code'       => 'nullable|string|max:10',
            'nib'               => 'nullable|string|max:50',
            'npwp'              => 'nullable|string|max:50',
            'instagram'         => 'nullable|string|max:255',
            'facebook'          => 'nullable|string|max:255',
            'latitude'          => 'nullable|numeric',
            'longitude'         => 'nullable|numeric',
            'legal_document'    => 'required|image|max:5120', // Max 5MB
            'store_photo'       => 'required|image|max:5120',
        ]);

        $tenant = Auth::user()->tenant;

        $imageService = app(\App\Services\ImageService::class);
        
        // Handle Legal Document (NIB/KTP)
        if ($request->hasFile('legal_document')) {
            $result = $imageService->uploadAndConvert($request->file('legal_document'), 'tenants/legal', 800, 85);
            $validated['legal_document'] = $result['path'];
        }

        // Handle Store Photo (Foto Toko/Usaha)
        if ($request->hasFile('store_photo')) {
            $result = $imageService->uploadAndConvert($request->file('store_photo'), 'tenants/store', 800, 85);
            $validated['store_photo'] = $result['path'];
        }

        $validated['onboarding_step'] = 2;
        $tenant->update($validated);

        return response()->json(['success' => true, 'step' => 2]);
    }

    /**
     * Save Step 2: Pilih Domain
     */
    public function saveDomain(Request $request)
    {
        $validated = $request->validate([
            'domain_type' => 'required|in:free,custom',
            'domain_name' => 'nullable|required_if:domain_type,custom|string|max:255',
            'slug'        => 'nullable|string|max:100', // Now it's always submitted (fallback)
        ]);

        $tenant = Auth::user()->tenant;

        // 1. ALWAYS assign a slug (Free subdomain fallback)
        $slug = \Illuminate\Support\Str::slug($validated['slug'] ?? $tenant->business_name);
        if (\App\Models\Tenant::where('slug', $slug)->where('id', '!=', $tenant->id)->exists()) {
            $slug .= '-' . \Illuminate\Support\Str::random(4);
        }

        if ($validated['domain_type'] === 'free') {
            $tenant->update([
                'slug'            => $slug,
                'plan'            => 'free',
                'onboarding_step' => 3,
                'status'          => 'active',
            ]);
            return response()->json(['success' => true, 'step' => 3]);
        }

        // 2. Custom Domain Logic
        $domainName = $validated['domain_name'];
        $tld = '.' . implode('.', array_slice(explode('.', $domainName), 1));
        
        $basePrices = [
            '.com'   => 150000, '.id'    => 250000, '.net'   => 175000,
            '.org'   => 180000, '.co.id' => 300000, '.my.id' => 15000,
            '.biz.id'=> 20000,  '.sch.id'=> 60000,
        ];
        
        $basePrice = $basePrices[$tld] ?? 150000;
        $markup = $basePrice * 2;
        $adminFee = 10000;
        $subTotal = $markup + $adminFee;
        $tax = round($subTotal * 0.11);
        $totalPrice = $subTotal + $tax;

        // Update Tenant: Activating with fallback free subdomain but marked as 'pro' intention
        $tenant->update([
            'slug'            => $slug,
            'domain_name'     => $domainName,
            'plan'            => 'pro',
            'onboarding_step' => 3,
            'status'          => 'active',
        ]);

        // Create Order
        $order = \App\Models\TenantOrder::create([
            'tenant_id'      => $tenant->id,
            'invoice_number' => 'INV-' . time() . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
            'total_amount'   => $totalPrice,
            'domain_name'    => $domainName,
            'domain_price'   => $totalPrice,
            'payment_status' => 'pending',
        ]);

        // Generate Snap Token
        try {
            $midtrans = new \App\Services\MidtransService();
            $snapToken = $midtrans->getSnapToken(
                [
                    'order_id'     => $order->invoice_number,
                    'gross_amount' => $totalPrice,
                ],
                [
                    'first_name' => $tenant->business_name,
                    'email'      => Auth::user()->email,
                    'phone'      => $tenant->whatsapp,
                ]
            );

            $order->update(['snap_token' => $snapToken]);

            return response()->json([
                'success'    => true, 
                'step'       => 3,
                'snap_token' => $snapToken
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Gagal menghubungkan ke payment gateway: ' . $e->getMessage()
            ], 500);
        }
    }
}
