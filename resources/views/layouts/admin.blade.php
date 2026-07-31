<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — HVM Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
    @stack('head')
    <style>
        [x-cloak] { display: none !important; }
        * { font-family: 'Inter', sans-serif; }

        /* Sidebar */
        .admin-sidebar {
            background: #0d1f15;
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
            color: rgba(255,255,255,0.45);
            transition: all 0.2s ease;
            text-decoration: none;
            margin-bottom: 2px;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.05);
            color: rgba(255,255,255,0.85);
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

        /* Alert */
        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        /* Table */
        .admin-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .admin-table th {
            text-align: left;
            padding: 10px 14px;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #6b7280;
            background: #f9fafb;
            border-bottom: 1px solid #f0f0f0;
        }
        .admin-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #f4f4f4;
            color: #374151;
            vertical-align: middle;
        }
        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: #f9fbf9; }

        /* Badges */
        .badge-green { background:#dcfce7; color:#15803d; padding:2px 10px; border-radius:20px; font-size:11px; font-weight:600; }
        .badge-gray  { background:#f3f4f6; color:#6b7280; padding:2px 10px; border-radius:20px; font-size:11px; font-weight:600; }
        .badge-blue  { background:#dbeafe; color:#1d4ed8; padding:2px 10px; border-radius:20px; font-size:11px; font-weight:600; }

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
        .btn-danger { background:#fee2e2; color:#dc2626; padding:6px 14px; border-radius:8px; font-size:12px; font-weight:500; border:none; cursor:pointer; transition:background 0.2s; }
        .btn-danger:hover { background:#fecaca; }
        .btn-secondary { background:#f3f4f6; color:#374151; padding:8px 16px; border-radius:10px; font-size:13px; font-weight:500; border:1px solid #e5e7eb; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:all 0.2s; }
        .btn-secondary:hover { background:#e5e7eb; }

        /* Form */
        .form-label { display:block; font-size:13px; font-weight:500; color:#374151; margin-bottom:6px; }
        .form-input {
            width:100%;
            padding:9px 13px;
            border:1px solid #d1d5db;
            border-radius:10px;
            font-size:13px;
            background:#fff;
            color:#111827;
            outline:none;
            transition:border-color 0.2s, box-shadow 0.2s;
            box-sizing:border-box;
        }
        .form-input:focus { border-color:#075749; box-shadow:0 0 0 3px rgba(7,87,73,0.08); }
        .form-select {
            width:100%;
            padding:9px 13px;
            border:1px solid #d1d5db;
            border-radius:10px;
            font-size:13px;
            background:#fff;
            color:#111827;
            outline:none;
            transition:border-color 0.2s;
            box-sizing:border-box;
        }
        .form-select:focus { border-color:#075749; box-shadow:0 0 0 3px rgba(7,87,73,0.08); }
        .form-textarea {
            width:100%;
            padding:9px 13px;
            border:1px solid #d1d5db;
            border-radius:10px;
            font-size:13px;
            background:#fff;
            color:#111827;
            outline:none;
            resize:vertical;
            min-height:100px;
            transition:border-color 0.2s;
            box-sizing:border-box;
        }
        .form-textarea:focus { border-color:#075749; box-shadow:0 0 0 3px rgba(7,87,73,0.08); }

        @media(max-width:1023px){
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-main { margin-left: 0; }
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
                    <div style="color:rgba(255,255,255,0.3);font-size:11px;">Admin Panel</div>
                </div>
            </div>
        </div>

        {{-- Search feel --}}
        <div style="padding:14px 14px 8px;">
            <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.07);border-radius:9px;padding:7px 12px;display:flex;align-items:center;gap:8px;">
                <svg width="13" height="13" fill="none" stroke="rgba(255,255,255,0.3)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <span style="color:rgba(255,255,255,0.25);font-size:12px;">Cari menu...</span>
            </div>
        </div>

        {{-- Nav --}}
        <nav style="flex:1;padding:6px 10px;">
            <div style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:rgba(255,255,255,0.2);padding:10px 6px 6px;">Navigasi</div>
            @php
            $role = session('admin_role', 'admin');
            $nav = [
                ['route'=>'admin.dashboard',              'label'=>'Dashboard',        'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route'=>'admin.analytics.index',        'label'=>'Analytics',         'icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['route'=>'admin.leads.index',            'label'=>'Leads CRM',         'icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                ['route'=>'admin.users.index',            'label'=>'Akses Admin',       'icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ['route'=>'admin.articles.index',         'label'=>'Artikel',          'icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                ['route'=>'admin.article-categories.index','label'=>'Kategori Artikel','icon'=>'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                ['route'=>'admin.services.index',         'label'=>'Layanan',          'icon'=>'M13 10V3L4 14h7v7l9-11h-7z'],
                ['route'=>'admin.portfolios.index',       'label'=>'Portfolio',         'icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['route'=>'admin.testimonials.index',     'label'=>'Testimoni',         'icon'=>'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                ['route'=>'admin.pricing_packages.index', 'label'=>'Paket Harga',       'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['route'=>'admin.faqs.index',             'label'=>'FAQ',              'icon'=>'M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['route'=>'admin.page-management.index',    'label'=>'Page Management',    'icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['route'=>'admin.hero-slides.index',      'label'=>'Hero Slider',      'icon'=>'M4 6h16M4 12h16M4 18h16'],
                ['route'=>'admin.internships.index',      'label'=>'Internships',      'icon'=>'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                ['route'=>'admin.careers.index',          'label'=>'Karir',            'icon'=>'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
            ];

            if ($role === 'copywriter') {
                $nav = array_filter($nav, function($item) {
                    return in_array($item['route'], ['admin.dashboard', 'admin.articles.index', 'admin.article-categories.index']);
                });
            }
            @endphp
            @foreach($nav as $item)
            @php $active = request()->routeIs($item['route']) || request()->routeIs(str_replace('.index','',$item['route']).'*'); @endphp
            <a href="{{ route($item['route']) }}" class="nav-item {{ $active ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/></svg>
                {{ $item['label'] }}
            </a>
            @endforeach

            @if(session('admin_role', 'admin') === 'admin')
            <div style="margin-top:12px;border-top:1px solid rgba(255,255,255,0.05);padding-top:12px;">
                <div style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;color:rgba(255,255,255,0.2);padding:0 6px 6px;">Sistem</div>
                @php $settingActive = request()->routeIs('admin.settings*'); @endphp
                <a href="{{ route('admin.settings.index') }}" class="nav-item {{ $settingActive ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Pengaturan
                </a>
            </div>
            @endif
        </nav>

        {{-- User area --}}
        <div style="padding:14px;border-top:1px solid rgba(255,255,255,0.06);">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                <div style="width:32px;height:32px;background:linear-gradient(135deg,#9acb03,#075749);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:12px;flex-shrink:0;">{{ strtoupper(substr(session('admin_name','A'),0,1)) }}</div>
                <div>
                    <div style="color:#fff;font-size:12px;font-weight:500;">{{ session('admin_name','Admin') }}</div>
                    <div style="color:rgba(255,255,255,0.3);font-size:10px;">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" style="width:100%;text-align:left;background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);color:rgba(239,68,68,0.7);font-size:12px;padding:7px 12px;border-radius:8px;cursor:pointer;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="admin-main" style="flex:1;">

        {{-- Topbar --}}
        <header class="admin-topbar">
            <div style="display:flex;align-items:center;gap:12px;">
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden" style="background:none;border:none;cursor:pointer;padding:4px;">
                    <svg width="20" height="20" fill="none" stroke="#374151" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h1 style="font-size:16px;font-weight:700;color:#111827;margin:0;line-height:1.2;">@yield('page-title', 'Dashboard')</h1>
                    <p style="font-size:11px;color:#9ca3af;margin:0;font-weight:400;">@yield('page-subtitle', 'Selamat datang kembali di panel admin HVM Digital')</p>
                </div>
            </div>
            <div style="display:flex;align-items:center;gap:16px;">
                <a href="{{ route('home') }}" target="_blank" style="display:flex;align-items:center;gap:6px;background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:500;text-decoration:none;transition:all 0.2s;">
                    <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Lihat Website
                </a>
                <div style="display:flex;align-items:center;gap:8px;">
                    <div style="width:32px;height:32px;background:linear-gradient(135deg,#9acb03,#075749);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:12px;">{{ strtoupper(substr(session('admin_name','A'),0,1)) }}</div>
                    <span style="font-size:13px;font-weight:500;color:#374151;">{{ session('admin_name','Admin') }}</span>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main style="flex:1;padding:24px 28px;">
            @if(session('success'))
            <div class="alert-success">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert-error">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
            @endif
            @if($errors->any())
            <div class="alert-error" style="flex-direction:column;align-items:flex-start;">
                <div style="display:flex;align-items:center;gap:8px;font-weight:600;margin-bottom:6px;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Terdapat kesalahan:
                </div>
                <ul style="margin:0;padding-left:20px;">@foreach($errors->all() as $e)<li style="font-size:12px;">{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
