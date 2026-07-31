<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantDashboardController extends Controller
{
    /**
     * Dashboard Home for Tenant
     */
    public function index()
    {
        $tenant = Auth::user()->tenant;
        
        // Ensure tenant exists
        if (!$tenant) {
            return redirect()->route('onboarding');
        }

        return view('tenant.dashboard.index', compact('tenant'));
    }
}
