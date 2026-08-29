<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — HVM Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @php
        $faviconUrl = setting('favicon') ? get_image_url(setting('favicon')) : asset('favicon.ico');
        $faviconExt = pathinfo($faviconUrl, PATHINFO_EXTENSION);
        $faviconType = 'image/x-icon';
        if ($faviconExt === 'png') $faviconType = 'image/png';
        elseif ($faviconExt === 'svg') $faviconType = 'image/svg+xml';
        elseif ($faviconExt === 'webp') $faviconType = 'image/webp';
        elseif (in_array($faviconExt, ['jpg', 'jpeg'])) $faviconType = 'image/jpeg';
    @endphp
    <link rel="icon" href="{{ $faviconUrl }}" type="{{ $faviconType }}">
    <link rel="shortcut icon" href="{{ $faviconUrl }}" type="{{ $faviconType }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @php
        $isProduction = setting('midtrans_is_production') === '1';
        $snapUrl = $isProduction ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js';
    @endphp
    <script src="{{ $snapUrl }}" data-client-key="{{ setting('midtrans_client_key') }}"></script>
    
    @stack('head')
    <style>
        [x-cloak] { display: none !important; }
        * { font-family: 'Montserrat', sans-serif !important; }

        /* Sidebar */
        .admin-sidebar {
            background: #0a0a0a;
            width: 240px;
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 40;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            overflow-y: auto;
            scrollbar-width: none;
        }
        .admin-sidebar::-webkit-scrollbar { display: none; }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 400;
            color: rgba(255,255,255,0.5);
            transition: all 0.2s ease;
            text-decoration: none;
            margin-bottom: 2px;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.07);
            color: rgba(255,255,255,0.9);
        }
        .nav-item.active {
            background: rgba(154,203,3,0.12);
            color: #9acb03;
            font-weight: 500;
        }
        .nav-item svg { width: 16px; height: 16px; flex-shrink: 0; }

        /* Main area */
        .admin-main {
            margin-left: 240px;
            min-height: 100vh;
            background: #f1f5f2;
            display: flex;
            flex-direction: column;
            width: calc(100% - 240px);
        }

        /* Topbar */
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0 28px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 30;
        }

        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px 22px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid #eef0ee;
            transition: box-shadow 0.2s;
        }
        .stat-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.08); }

        .panel {
            background: #fff;
            border-radius: 16px;
            padding: 22px 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            border: 1px solid #eef0ee;
        }
        
        .dark-panel {
            background: #0d1f15;
            border-radius: 16px;
            padding: 22px 24px;
            color: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        /* Buttons */
        .btn-primary {
            background: #075749;
            color: #fff;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
        }
        .btn-primary:hover { background: #0a6d58; }
        .btn-secondary { background:#f3f4f6; color:#374151; padding:8px 16px; border-radius:10px; font-size:13px; font-weight:500; border:1px solid #e5e7eb; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; }
        .btn-secondary:hover { background:#e5e7eb; }
        .btn-accent { background: #9acb03; color: #0d1f15; padding: 10px 20px; border-radius: 10px; font-size: 14px; font-weight: 600; text-align: center; display: inline-block; transition: all 0.2s; border: none; cursor: pointer; }
        .btn-accent:hover { transform: scale(1.02); box-shadow: 0 4px 12px rgba(154,203,3,0.3); }

        @media(max-width:1023px){
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; width: 100%; }
        }
    </style>
</head>
<body style="background:#f1f5f2; margin:0;">

<div style="display:flex; min-height:100vh;">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar" :class="sidebarOpen ? 'open' : ''">
        {{-- Brand --}}
        <div style="padding:20px 18px; border-bottom:1px solid rgba(255,255,255,0.06);">
            <div style="display:flex; align-items:center; gap:10px;">
                <img src="{{ $faviconUrl }}" alt="Logo HVM" style="width:36px;height:36px;border-radius:10px;object-fit:cover;flex-shrink:0;border:1px solid rgba(255,255,255,0.08);">
                <div>
                    <div style="color:#fff;font-weight:700;font-size:14px;line-height:1.2;">HVM Digital</div>
                    <div style="color:rgba(255,255,255,0.3);font-size:11px;font-weight:300;">Bisnis Dashboard</div>
                </div>
            </div>
        </div>

        {{-- Nav --}}
        <nav style="padding:14px; flex:1;">
            <div style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:rgba(255,255,255,0.2);padding:0 6px 6px;">Navigasi</div>
            
            <a href="{{ route('tenant.dashboard') }}" class="nav-item {{ request()->routeIs('tenant.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Dashboard
            </a>
            
            <a href="{{ route('tenant.upgrade') }}" class="nav-item {{ request()->routeIs('tenant.upgrade*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                Upgrade Website
            </a>
        </nav>

        {{-- User area --}}
        <div style="padding:14px;border-top:1px solid rgba(255,255,255,0.06);">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                <div style="width:32px;height:32px;background:linear-gradient(135deg,#9acb03,#075749);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:12px;flex-shrink:0;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
                <div style="overflow:hidden;">
                    <div style="color:#fff;font-size:12px;font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::user()->name }}</div>
                    <div style="color:rgba(255,255,255,0.3);font-size:10px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{!! Auth::user()->tenant->business_name ?? 'UMKM' !!}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="width:100%;text-align:left;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);color:rgba(239,68,68,0.7);font-size:12px;padding:7px 12px;border-radius:8px;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Overlay --}}
    <div x-show="sidebarOpen" style="display:none" @click="sidebarOpen = false" x-transition.opacity
         class="fixed inset-0 bg-black/50 z-30 lg:hidden"></div>

    {{-- MAIN --}}
    <div class="admin-main">
        {{-- Topbar --}}
        <header class="admin-topbar">
            <div style="display:flex;align-items:center;gap:12px;">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden" style="background:none;border:none;cursor:pointer;padding:4px;">
                    <svg width="20" height="20" fill="none" stroke="#374151" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h1 style="font-size:16px;font-weight:700;color:#111827;margin:0;line-height:1.2;">@yield('page-title', 'Dashboard')</h1>
                    <p style="font-size:11px;color:#9ca3af;margin:0;font-weight:400;">Pusat kendali bisnis Anda</p>
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:16px;">
                @if(Auth::user()->tenant && Auth::user()->tenant->publicUrl())
                <a href="{{ Auth::user()->tenant->publicUrl() }}" target="_blank" style="display:flex;align-items:center;gap:6px;background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:500;text-decoration:none;transition:all 0.2s;">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Website
                </a>
                @endif
                <div style="display:flex;align-items:center;gap:8px;">
                    <div style="width:32px;height:32px;background:linear-gradient(135deg,#9acb03,#075749);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:12px;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
                    <span style="font-size:13px;font-weight:500;color:#374151;" class="hidden sm:inline-block">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main style="flex:1;padding:24px 28px;">
            @php
                $pendingOrder = null;
                if (Auth::check() && Auth::user()->tenant) {
                    $pendingOrder = \App\Models\TenantOrder::where('tenant_id', Auth::user()->tenant->id)
                        ->where('payment_status', 'pending')
                        ->latest()
                        ->first();
                }
            @endphp
            
            @if($pendingOrder)
            <div style="background:linear-gradient(135deg, #fff7ed, #ffedd5); border:1px solid #fed7aa; border-radius:12px; padding:16px 20px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; gap:16px; box-shadow:0 4px 15px rgba(249,115,22,0.05);">
                <div style="display:flex; align-items:flex-start; gap:12px;">
                    <div style="background:#f97316; width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <svg width="20" height="20" fill="none" stroke="#fff" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h3 style="margin:0 0 4px 0; font-size:14px; font-weight:700; color:#9a3412;">Satu langkah lagi untuk domain profesional Anda!</h3>
                        <p style="margin:0; font-size:12px; color:#c2410c; line-height:1.4;">
                            Selesaikan pembayaran pesanan <strong>{{ $pendingOrder->invoice_number }}</strong> untuk domain <strong>{{ $pendingOrder->domain_name }}</strong> sebesar <strong>Rp {{ number_format($pendingOrder->total_amount, 0, ',', '.') }}</strong> agar website langsung online dengan ekstensi tersebut.
                        </p>
                    </div>
                </div>
                <button id="pay-pending-order" data-snap="{{ $pendingOrder->snap_token }}" style="background:#ea580c; color:#fff; border:none; padding:10px 20px; border-radius:8px; font-size:12px; font-weight:700; cursor:pointer; white-space:nowrap; box-shadow:0 2px 4px rgba(234,88,12,0.2); transition:all 0.2s;">
                    Bayar Sekarang
                </button>
            </div>
            
            <script>
                document.getElementById('pay-pending-order').addEventListener('click', function() {
                    var token = this.getAttribute('data-snap');
                    if (token) {
                        window.snap.pay(token, {
                            onSuccess: function(result){ window.location.reload(); },
                            onPending: function(result){ window.location.reload(); }
                        });
                    }
                });
            </script>
            @endif
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
