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
            'whatsapp'          => 'nullable|string|max:20',
            'email_business'    => 'nullable|email|max:255',
            'address'           => 'nullable|string|max:500',
            'city'              => 'nullable|string|max:100',
            'province'          => 'nullable|string|max:100',
            'postal_code'       => 'nullable|string|max:10',
            'nib'               => 'nullable|string|max:50',
            'npwp'              => 'nullable|string|max:50',
            'instagram'         => 'nullable|string|max:255',
            'facebook'          => 'nullable|string|max:255',
            'legal_document'    => 'nullable|image|max:5120', // Max 5MB
            'store_photo'       => 'nullable|image|max:5120',
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
            'slug'        => 'nullable|required_if:domain_type,free|string|max:100',
        ]);

        $tenant = Auth::user()->tenant;

        if ($validated['domain_type'] === 'free') {
            $slug = Str::slug($validated['slug']);
            if (Tenant::where('slug', $slug)->where('id', '!=', $tenant->id)->exists()) {
                $slug .= '-' . Str::random(4);
            }
            
            $tenant->update([
                'slug'            => $slug,
                'plan'            => 'free',
                'onboarding_step' => 3,
                'status'          => 'active', // Free users go live immediately
            ]);
        } else {
            $tenant->update([
                'plan'            => 'pro',
                'onboarding_step' => 3,
            ]);
            // Domain checkout will be handled separately via Midtrans
        }

        return response()->json(['success' => true, 'step' => 3]);
    }
}
