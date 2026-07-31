<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - {{ config('app.name', 'HVM Digital') }}</title>

    @php
        $faviconUrl = setting('favicon') ? get_image_url(setting('favicon')) : asset('favicon.ico');
    @endphp
    <link rel="icon" href="{{ $faviconUrl }}">
    
    {{-- Direct Google Fonts for guaranteed loading without JS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        (function(){
            var t=localStorage.getItem('hvm-theme');
            var d=window.matchMedia('(prefers-color-scheme: dark)').matches;
            if(t==='dark'||(t===null&&d)){document.documentElement.classList.add('dark');}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-montserrat antialiased bg-surface text-fg min-h-screen relative overflow-x-hidden flex" x-data="{ sidebarOpen: false }">
    
    {{-- Global Background Gradient (Premium Dark) --}}
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-[#9acb03]/5 dark:bg-[#9acb03]/10 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-32 -mb-32 w-96 h-96 rounded-full bg-[#075749]/10 dark:bg-[#075749]/20 blur-3xl"></div>
    </div>

    {{-- Mobile Overlay --}}
    <div x-show="sidebarOpen" style="display:none" @click="sidebarOpen = false" x-transition.opacity
         class="fixed inset-0 bg-black/50 z-40 lg:hidden backdrop-blur-sm"></div>

    {{-- Sidebar --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed lg:static inset-y-0 left-0 w-72 bg-white/5 dark:bg-black/20 backdrop-blur-xl border-r border-white/5 z-50 flex flex-col transition-transform duration-300 lg:translate-x-0 shadow-2xl lg:shadow-none">
        
        {{-- Sidebar Header (Logo) --}}
        <div class="h-20 flex items-center px-8 border-b border-white/5 shrink-0">
            <a href="{{ route('tenant.dashboard') }}" class="inline-block transition-transform hover:scale-105">
                @php
                    $logoUrl = setting('logo_white') ? get_image_url(setting('logo_white')) : asset('images/logohvm.png');
                @endphp
                <img src="{{ $logoUrl }}" alt="HVM Digital" class="h-8 w-auto">
            </a>
            <button @click="sidebarOpen = false" class="ml-auto lg:hidden text-muted hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Sidebar Navigation --}}
        <div class="flex-1 overflow-y-auto py-6 px-4 custom-scrollbar space-y-1">
            <a href="{{ route('tenant.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('tenant.dashboard') ? 'bg-[#9acb03]/10 text-[#9acb03] border border-[#9acb03]/20 shadow-[0_0_15px_rgba(154,203,3,0.1)]' : 'text-muted hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                <span class="font-medium text-sm">Dashboard</span>
            </a>
            
            {{-- Feature: Upgrade Website --}}
            <a href="#" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('tenant.upgrade*') ? 'bg-[#9acb03]/10 text-[#9acb03] border border-[#9acb03]/20 shadow-[0_0_15px_rgba(154,203,3,0.1)]' : 'text-muted hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                <span class="font-medium text-sm">Upgrade Website</span>
                @if(Auth::user()->tenant && Auth::user()->tenant->plan !== 'pro')
                <span class="ml-auto flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                </span>
                @endif
            </a>

            <div class="pt-6 pb-2">
                <p class="px-4 text-xs font-semibold text-muted uppercase tracking-wider">Manajemen Website</p>
            </div>
            
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-muted hover:bg-white/5 hover:text-white cursor-not-allowed opacity-50">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <span class="font-medium text-sm">Konten & Artikel</span>
                <span class="ml-auto text-[9px] bg-white/10 px-2 py-0.5 rounded-full">Segera</span>
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-muted hover:bg-white/5 hover:text-white cursor-not-allowed opacity-50">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span class="font-medium text-sm">Produk & Katalog</span>
                <span class="ml-auto text-[9px] bg-white/10 px-2 py-0.5 rounded-full">Segera</span>
            </a>
        </div>

        {{-- Sidebar Footer --}}
        <div class="p-6 border-t border-white/5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl border border-red-500/30 text-red-400 hover:bg-red-500/10 transition-colors text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 flex flex-col min-w-0 relative z-10 h-screen overflow-y-auto custom-scrollbar">
        
        {{-- Topbar --}}
        <header class="h-20 flex items-center justify-between px-6 lg:px-10 sticky top-0 bg-surface/80 dark:bg-[#061009]/80 backdrop-blur-xl border-b border-white/5 z-40">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 rounded-lg text-muted hover:bg-white/5 hover:text-fg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-xl font-bold text-fg hidden sm:block">@yield('page-title', 'Dashboard')</h1>
            </div>

            <div class="flex items-center gap-4">
                {{-- User Dropdown (Simple for now) --}}
                <div class="flex items-center gap-3 bg-white/5 border border-white/5 rounded-full pl-2 pr-4 py-1.5 cursor-pointer hover:bg-white/10 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-[#075749] text-[#9acb03] flex items-center justify-center font-bold text-sm shadow-inner shrink-0">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="hidden sm:flex flex-col">
                        <span class="text-sm font-semibold text-fg leading-tight">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-muted">{{ Auth::user()->tenant->business_name ?? 'UMKM' }}</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <div class="p-6 lg:p-10">
            @yield('content')
        </div>

    </main>
    
    @stack('scripts')
    <style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
    </style>
</body>
</html>
