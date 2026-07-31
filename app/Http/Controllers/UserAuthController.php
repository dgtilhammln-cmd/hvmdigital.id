<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class UserAuthController extends Controller
{
    public function showRegister()
    {
        if (Auth::check() && Auth::user()->isTenant()) {
            return redirect()->route('onboarding');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'],
            'role'     => 'user',
        ]);

        // Auto-create tenant in onboarding state
        Tenant::create([
            'user_id'       => $user->id,
            'business_name' => $validated['name'] . "'s Business",
            'slug'          => Str::slug($validated['name']) . '-' . Str::random(4),
            'whatsapp'      => $validated['phone'],
            'status'        => 'onboarding',
            'onboarding_step' => 1,
        ]);

        Auth::login($user);

        return redirect()->route('onboarding');
    }

    public function showLogin()
    {
        if (Auth::check() && Auth::user()->isTenant()) {
            return redirect()->route('onboarding');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect admin to admin dashboard
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            // Redirect tenant user to onboarding or dashboard
            $tenant = $user->tenant;
            if ($tenant && $tenant->status === 'active') {
                return redirect()->route('tenant.dashboard');
            }

            return redirect()->route('onboarding');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
