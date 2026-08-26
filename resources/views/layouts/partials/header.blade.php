{{-- resources/views/layouts/partials/header.blade.php --}}
<header id="navbar"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
    x-data="{ mobileMenu: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 50)">

    {{-- Top Bar (Socials & Changing Text) --}}
    <div class="bg-[#075749]/90 dark:bg-[#061009]/80 backdrop-blur-md text-white/80 transition-all duration-500 overflow-hidden"
         :class="scrolled ? 'h-0 opacity-0 py-0 border-transparent' : 'h-10 opacity-100 py-2 border-b border-white/5'">
        <div class="container mx-auto px-4 lg:px-8 flex items-center justify-between h-full text-[11px] font-light tracking-wide uppercase">
            {{-- Left: Socials --}}
            <div class="flex items-center gap-4">
                <span class="text-white/40 hidden sm:inline-block">FOLLOW US:</span>
                <div class="flex items-center gap-4">
                    {{-- Instagram --}}
                    <a href="https://www.instagram.com/hvmdigital.id" target="_blank" class="hover:text-[#9acb03] hover:-translate-y-0.5 transition-all flex items-center gap-1.5" title="Instagram" aria-label="Instagram HVM Digital">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    {{-- TikTok --}}
                    <a href="https://www.tiktok.com/@hvmdigital.id" target="_blank" class="hover:text-[#9acb03] hover:-translate-y-0.5 transition-all flex items-center gap-1.5" title="TikTok" aria-label="TikTok HVM Digital">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 2.22-1.15 4.41-2.9 5.6-1.45 1-3.28 1.43-5.06 1.19-2.06-.28-3.95-1.55-4.88-3.41-.83-1.66-1.04-3.65-.49-5.43.51-1.65 1.7-3.08 3.25-3.83 1.09-.54 2.33-.74 3.55-.66v4.06c-.66-.02-1.34.05-1.95.34-.84.41-1.5 1.19-1.68 2.13-.19.98.05 2.05.69 2.8.69.81 1.8 1.25 2.87 1.16 1.06-.09 2.04-.68 2.58-1.59.45-.75.64-1.63.66-2.52.06-5.83.02-11.66.02-17.5h.28z"/></svg>
                    </a>
                    {{-- LinkedIn --}}
                    <a href="https://www.linkedin.com/company/hvm-digital-id" target="_blank" class="hover:text-[#9acb03] hover:-translate-y-0.5 transition-all flex items-center gap-1.5" title="LinkedIn" aria-label="LinkedIn HVM Digital">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    {{-- Threads --}}
                    <a href="https://www.threads.net/@hvmdigital" target="_blank" class="hover:text-[#9acb03] hover:-translate-y-0.5 transition-all flex items-center gap-1.5" title="Threads" aria-label="Threads HVM Digital">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M14.545 11.238l-2.05-1.572a.853.853 0 00-.737-.17c-.453.076-.84.453-.941.895-.121.536.027 1.096.402 1.498.423.454.992.656 1.614.542l1.712-.315zm.603 2.628c-.689.691-1.68 1.132-2.73 1.132-2.032 0-3.684-1.64-3.684-3.655 0-2.016 1.652-3.656 3.684-3.656 1.036 0 2.012.43 2.695 1.104l1.192-1.391a5.413 5.413 0 00-3.887-1.542c-3.036 0-5.503 2.45-5.503 5.485 0 3.033 2.467 5.483 5.503 5.483 1.487 0 2.871-.592 3.896-1.579zm6.657-1.874V12c0-5.46-4.463-9.923-9.923-9.923C6.42 2.077 1.958 6.54 1.958 12S6.42 21.923 11.882 21.923c1.773 0 3.498-.485 5.01-1.4l-1.042-1.442a8.03 8.03 0 01-3.968.966c-4.425 0-8.02-3.596-8.02-8.047 0-4.453 3.595-8.048 8.02-8.048 4.424 0 8.018 3.595 8.018 8.048v.01c0 1.576-1.282 2.858-2.858 2.858H16.89c-.664 0-1.286-.25-1.765-.694a5.378 5.378 0 01-2.98.922c-2.453 0-4.45-1.996-4.45-4.45 0-2.454 1.997-4.451 4.45-4.451 1.832 0 3.46 1.133 4.137 2.793h.755c0-.623.504-1.127 1.127-1.127.622 0 1.126.504 1.126 1.127v.757c0 2.502 2.036 4.538 4.538 4.538 2.501 0 4.537-2.036 4.537-4.538 0-.003 0-.007 0-.01z"/></svg>
                    </a>
                </div>
            </div>
            
            {{-- Right: Changing Text --}}
            <div class="hidden md:flex items-center gap-2" 
                 x-data="{ texts: ['UMKM Go Digital', 'Upgrade Your System', 'Meroket With HVM'], index: 0 }" 
                 x-init="setInterval(() => { index = (index + 1) % texts.length }, 3000)">
                <span class="w-1.5 h-1.5 rounded-full bg-[#9acb03] shadow-[0_0_8px_#9acb03] animate-pulse"></span>
                <span class="text-[#9acb03] font-medium" x-text="texts[index]"></span>
            </div>
        </div>
    </div>

    {{-- Main Navbar --}}
    <div :class="scrolled ? 'bg-[#075749]/95 dark:bg-[#061009]/95 backdrop-blur-xl shadow-[0_10px_30px_rgba(0,0,0,0.3)] py-3 border-b border-white/5' : 'bg-[#075749]/90 dark:bg-[#061009]/80 backdrop-blur-md py-5 border-b border-white/5'"
         class="transition-all duration-500">
        <div class="container mx-auto px-4 lg:px-8 flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 relative">
                @php
                    $logoUrl = setting('logo_white') ? get_image_url(setting('logo_white')) : (setting('logo') ? get_image_url(setting('logo')) : asset('images/logohvm.png'));
                @endphp
                <img src="{{ $logoUrl }}"
                     alt="{{ setting('site_name', 'HVM Digital') }}"
                     class="h-10 md:h-11 w-auto relative z-10"
                     width="160"
                     height="44"
                     loading="eager">
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-8">
                @php
                $headerServices = \App\Models\Service::orderBy('id')->get();
                $serviceIcons = [
                    'monitor'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                    'search'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>',
                    'ai'         => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
                    'smartphone' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>',
                    'palette'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
                    'video'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>',
                    'cpu'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18"/>',
                    'share'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>',
                    'trending'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>',
                    'default'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                ];
                $navLinks = [
                    ['route'=>'home',      'label'=>'Beranda'],
                    ['route'=>'portfolio', 'label'=>'Portfolio'],
                    ['route'=>'articles',  'label'=>'Artikel'],
                    ['route'=>'contact',   'label'=>'Kontak'],
                ];
                @endphp
                

                {{-- Dropdown Layanan --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="{{ route('services') }}" class="relative text-white/80 hover:text-white font-light text-sm tracking-wide transition-colors flex items-center gap-1 py-2 {{ request()->routeIs('services*') ? 'text-[#9acb03]' : '' }}">
                        Layanan
                        <svg class="w-4 h-4 transition-transform duration-300" :class="open ? 'rotate-180 text-[#9acb03]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        <span class="absolute bottom-0 left-0 h-0.5 bg-[#9acb03] rounded-full transition-all duration-500 ease-out {{ request()->routeIs('services*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    
                    {{-- Dropdown Menu Layanan (Compact Mega Menu) --}}
                    <div x-show="open"
                         style="display: none;"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-4"
                         class="absolute top-full left-1/2 -translate-x-1/2 mt-5 w-[480px] lg:w-[560px] bg-white dark:bg-[#0a1f12] rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.2)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.6)] border border-gray-100 dark:border-white/10 p-4 z-50">
                         
                         {{-- Invisible bridge for hover --}}
                         <div class="absolute -top-5 left-0 right-0 h-5 bg-transparent"></div>

                         <div class="grid grid-cols-2 gap-1.5">
                             @foreach($headerServices as $svc)
                             <a href="{{ route('services.show', $svc) }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                                 <div class="w-9 h-9 rounded-lg flex flex-shrink-0 items-center justify-center border border-transparent dark:border-white/10 text-[#075749] dark:text-[#9acb03] bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/15 group-hover:from-[#075749] group-hover:to-[#9acb03] dark:group-hover:from-[#9acb03]/20 dark:group-hover:to-[#9acb03]/10 group-hover:text-white transition-all shadow-2xs group-hover:shadow-sm">
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         {!! $serviceIcons[$svc->icon ?? 'default'] ?? $serviceIcons['default'] !!}
                                     </svg>
                                 </div>
                                 <div class="flex-1 min-w-0">
                                     <h4 class="font-bold text-[#0a1f12] dark:text-white text-xs group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors mb-0.5 truncate">{{ $svc->name }}</h4>
                                     <p class="text-[11px] text-gray-500 dark:text-white/50 truncate font-light">{{ $svc->short_description }}</p>
                                 </div>
                             </a>
                             @endforeach
                         </div>
                         
                         {{-- Bottom bar CTA inside dropdown --}}
                         <div class="mt-3 pt-3 border-t border-gray-100 dark:border-white/10 flex justify-between items-center px-2">
                            <p class="text-[11px] text-gray-500 dark:text-white/50 font-light">Tidak menemukan yang Anda butuhkan?</p>
                            <a href="{{ wa_link('Halo HVM Digital, saya butuh layanan custom') }}" target="_blank" class="text-[#075749] dark:text-[#9acb03] text-[11px] font-semibold hover:underline flex items-center gap-1">Konsultasi Kustom <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                         </div>
                    </div>
                </div>

                {{-- Dropdown Trigger Aktifitas --}}
                <div x-data="{ openAktifitas: false }" @mouseenter="openAktifitas = true" @mouseleave="openAktifitas = false" class="relative group">
                    <button class="flex items-center gap-1 text-white/80 hover:text-white font-light text-sm tracking-wide transition-colors py-2">
                        Aktifitas
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        <span class="absolute bottom-0 left-0 h-0.5 bg-[#9acb03] rounded-full transition-all duration-500 ease-out {{ request()->routeIs('career*') || request()->routeIs('internship*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </button>
                    
                    {{-- Dropdown Menu Aktifitas (Compact Single Column) --}}
                    <div x-show="openAktifitas"
                         style="display: none;"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-4"
                         class="absolute top-full left-1/2 -translate-x-1/2 mt-5 w-[260px] lg:w-[280px] bg-white dark:bg-[#0a1f12] rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.2)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.6)] border border-gray-100 dark:border-white/10 p-3 z-50">
                         
                         <div class="absolute -top-5 left-0 right-0 h-5 bg-transparent"></div>

                         <div class="flex flex-col gap-1">
                             <a href="{{ route('career.index') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                                 <div class="w-9 h-9 rounded-lg flex flex-shrink-0 items-center justify-center border border-transparent dark:border-white/10 text-[#075749] dark:text-[#9acb03] bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/15 group-hover:from-[#075749] group-hover:to-[#9acb03] dark:group-hover:from-[#9acb03]/20 dark:group-hover:to-[#9acb03]/10 group-hover:text-white transition-all shadow-2xs group-hover:shadow-sm">
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                 </div>
                                 <div class="flex-1 min-w-0">
                                     <h4 class="font-bold text-[#0a1f12] dark:text-white text-xs group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors mb-0.5 truncate">Karir</h4>
                                     <p class="text-[11px] text-gray-500 dark:text-white/50 truncate font-light">Bergabung bersama tim inti HVM.</p>
                                 </div>
                             </a>
                             <a href="{{ route('internship.index') }}" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                                 <div class="w-9 h-9 rounded-lg flex flex-shrink-0 items-center justify-center border border-transparent dark:border-white/10 text-[#075749] dark:text-[#9acb03] bg-gradient-to-br from-[#075749]/10 to-[#9acb03]/15 group-hover:from-[#075749] group-hover:to-[#9acb03] dark:group-hover:from-[#9acb03]/20 dark:group-hover:to-[#9acb03]/10 group-hover:text-white transition-all shadow-2xs group-hover:shadow-sm">
                                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                 </div>
                                 <div class="flex-1 min-w-0">
                                     <h4 class="font-bold text-[#0a1f12] dark:text-white text-xs group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors mb-0.5 truncate">Internship</h4>
                                     <p class="text-[11px] text-gray-500 dark:text-white/50 truncate font-light">Program magang bersertifikat.</p>
                                 </div>
                             </a>
                         </div>
                    </div>
                </div>

                {{-- Sisa Menu --}}
                <a href="{{ route('portfolio') }}" class="relative text-white/80 hover:text-white font-light text-sm tracking-wide transition-colors group py-2 {{ request()->routeIs('portfolio') ? 'text-white' : '' }}">
                    Portfolio <span class="absolute bottom-0 left-0 h-0.5 bg-[#9acb03] rounded-full transition-all duration-500 ease-out {{ request()->routeIs('portfolio') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
                <a href="{{ route('articles') }}" class="relative text-white/80 hover:text-white font-light text-sm tracking-wide transition-colors group py-2 {{ request()->routeIs('articles') ? 'text-white' : '' }}">
                    Artikel <span class="absolute bottom-0 left-0 h-0.5 bg-[#9acb03] rounded-full transition-all duration-500 ease-out {{ request()->routeIs('articles') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
                <a href="{{ route('contact') }}" class="relative text-white/80 hover:text-white font-light text-sm tracking-wide transition-colors group py-2 {{ request()->routeIs('contact') ? 'text-white' : '' }}">
                    Kontak <span class="absolute bottom-0 left-0 h-0.5 bg-[#9acb03] rounded-full transition-all duration-500 ease-out {{ request()->routeIs('contact') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                </a>
            </nav>

            {{-- Right actions --}}
            <div class="hidden lg:flex items-center gap-3">
                {{-- Dark mode toggle --}}
                <button onclick="toggleTheme()" title="Toggle dark/light mode" aria-label="Ubah Tema Gelap Terang"
                        class="w-9 h-9 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-all">
                    {{-- Sun icon (visible in dark mode) --}}
                    <svg class="w-4 h-4 hidden dark:block" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.166 17.834a.75.75 0 00-1.06 1.06l1.59 1.591a.75.75 0 001.061-1.06l-1.59-1.591zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.166 6.166a.75.75 0 00-1.06 1.06l1.59 1.591a.75.75 0 001.061-1.06L6.166 6.166z"/>
                    </svg>
                    {{-- Moon icon (visible in light mode) --}}
                    <svg class="w-4 h-4 block dark:hidden" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd"/>
                    </svg>
                </button>

                {{-- Actions Dropdown --}}
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="relative wa-btn flex items-center gap-2 bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-semibold text-sm px-6 py-2.5 rounded-full hover:scale-105 transition-all duration-300 shadow-[0_4px_15px_rgba(154,203,3,0.3)] hover:shadow-[0_8px_25px_rgba(154,203,3,0.5)]">
                        <div class="absolute inset-0 bg-white/20 rounded-full blur opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <svg class="w-4 h-4 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span class="relative z-10">Actions</span>
                        <svg class="w-4 h-4 relative z-10 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    
                    {{-- Dropdown Menu --}}
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute right-0 mt-2 w-48 rounded-2xl bg-white dark:bg-[#0a1f12] shadow-xl border border-gray-100 dark:border-white/10 overflow-hidden py-2 z-50">
                        <a href="{{ wa_link(setting('wa_message_default','Halo HVM Digital, saya ingin konsultasi')) }}" target="_blank" onclick="trackWaClick('navbar')" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-white/80 hover:bg-[#f0fdf4] dark:hover:bg-[#075749]/50 hover:text-[#075749] dark:hover:text-[#9acb03] transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            Konsultasi
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-white/80 hover:bg-[#f0fdf4] dark:hover:bg-[#075749]/50 hover:text-[#075749] dark:hover:text-[#9acb03] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Register
                        </a>
                        <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 dark:text-white/80 hover:bg-[#f0fdf4] dark:hover:bg-[#075749]/50 hover:text-[#075749] dark:hover:text-[#9acb03] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                            Login
                        </a>
                    </div>
                </div>
            </div>

            {{-- Mobile: dark toggle + hamburger --}}
            <div class="lg:hidden flex items-center gap-2">
                <button onclick="toggleTheme()" aria-label="Ubah Tema Gelap Terang" class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-white">
                    <svg class="w-4 h-4 hidden dark:block" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.166 17.834a.75.75 0 00-1.06 1.06l1.59 1.591a.75.75 0 001.061-1.06l-1.59-1.591zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.166 6.166a.75.75 0 00-1.06 1.06l1.59 1.591a.75.75 0 001.061-1.06L6.166 6.166z"/></svg>
                    <svg class="w-4 h-4 block dark:hidden" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd"/></svg>
                </button>
                <button @click="mobileMenu = !mobileMenu" aria-label="Menu Navigasi Mobile" class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-white">
                    <svg x-show="!mobileMenu" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileMenu" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenu"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="lg:hidden absolute top-full left-0 right-0 bg-[#075749]/95 dark:bg-[#0a1f12]/95 backdrop-blur-xl border-t border-white/10 px-4 py-6 shadow-[0_20px_40px_rgba(0,0,0,0.5)]">
        <div class="flex flex-col space-y-1">
            
            {{-- Mobile Dropdown Layanan --}}
            <div x-data="{ openMobile: false }" class="border-b border-white/5">
                <button @click="openMobile = !openMobile" class="flex items-center justify-between w-full text-left text-white/80 hover:text-[#9acb03] py-3 text-sm font-light transition-colors">
                    Layanan
                    <svg class="w-4 h-4 transition-transform duration-300" :class="openMobile ? 'rotate-180 text-[#9acb03]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openMobile" x-collapse class="pl-4 pb-2 space-y-2">
                    <a href="{{ route('services') }}" @click="mobileMenu=false" class="flex items-center gap-3 py-2 text-white/80 hover:text-white transition-colors group border-b border-white/5 mb-2 pb-3">
                        <span class="text-sm font-medium">Lihat Semua Layanan</span>
                        <svg class="w-4 h-4 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @foreach($headerServices as $svc)
                    <a href="{{ route('services.show', $svc) }}" @click="mobileMenu=false" class="flex items-center gap-3 py-2 text-white/60 hover:text-white transition-colors group">
                        <div class="w-6 h-6 rounded flex items-center justify-center text-white bg-gradient-to-r from-[#075749]/40 to-[#9acb03]/40 group-hover:from-[#075749] group-hover:to-[#9acb03] transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $serviceIcons[$svc->icon ?? 'default'] ?? $serviceIcons['default'] !!}
                            </svg>
                        </div>
                        <span class="text-sm font-light">{{ $svc->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Mobile Dropdown Aktifitas --}}
            <div x-data="{ openMobileAktifitas: false }" class="border-b border-white/5">
                <button @click="openMobileAktifitas = !openMobileAktifitas" class="flex items-center justify-between w-full text-left text-white/80 hover:text-[#9acb03] py-3 text-sm font-light transition-colors">
                    Aktifitas
                    <svg class="w-4 h-4 transition-transform duration-300" :class="openMobileAktifitas ? 'rotate-180 text-[#9acb03]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="openMobileAktifitas" x-collapse class="pl-4 pb-2 space-y-2">
                    <a href="{{ route('career.index') }}" @click="mobileMenu=false" class="flex items-center gap-3 py-2 text-white/60 hover:text-white transition-colors group">
                        <div class="w-6 h-6 rounded flex items-center justify-center text-white bg-gradient-to-r from-[#075749]/40 to-[#9acb03]/40 group-hover:from-[#075749] group-hover:to-[#9acb03] transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-sm font-light">Karir</span>
                    </a>
                    <a href="{{ route('internship.index') }}" @click="mobileMenu=false" class="flex items-center gap-3 py-2 text-white/60 hover:text-white transition-colors group">
                        <div class="w-6 h-6 rounded flex items-center justify-center text-white bg-gradient-to-r from-[#075749]/40 to-[#9acb03]/40 group-hover:from-[#075749] group-hover:to-[#9acb03] transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <span class="text-sm font-light">Internship</span>
                    </a>
                </div>
            </div>

            <a href="{{ route('portfolio') }}" @click="mobileMenu=false" class="block text-white/80 hover:text-[#9acb03] py-3 text-sm font-light border-b border-white/5 transition-colors">Portfolio</a>
            <a href="{{ route('articles') }}" @click="mobileMenu=false" class="block text-white/80 hover:text-[#9acb03] py-3 text-sm font-light border-b border-white/5 transition-colors">Artikel</a>
            <a href="{{ route('contact') }}" @click="mobileMenu=false" class="block text-white/80 hover:text-[#9acb03] py-3 text-sm font-light border-b border-white/5 transition-colors">Kontak</a>
        </div>
        <div x-data="{ openMobileActions: false }" class="mt-6">
            <button @click="openMobileActions = !openMobileActions" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-[#075749] to-[#9acb03] text-white font-semibold text-sm px-5 py-3.5 rounded-xl shadow-[0_4px_15px_rgba(154,203,3,0.3)]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <span>Actions</span>
                <svg class="w-4 h-4 transition-transform duration-300" :class="openMobileActions ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="openMobileActions" x-collapse class="mt-2 bg-black/10 dark:bg-black/30 rounded-xl overflow-hidden border border-white/5">
                <a href="{{ wa_link(setting('wa_message_default','Halo HVM Digital, saya ingin konsultasi')) }}" target="_blank" onclick="trackWaClick('mobile-menu')" class="flex items-center gap-3 px-5 py-3 text-sm text-white/80 hover:text-white hover:bg-white/5 border-b border-white/5 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Konsultasi
                </a>
                <a href="{{ route('register') }}" class="flex items-center gap-3 px-5 py-3 text-sm text-white/80 hover:text-white hover:bg-white/5 border-b border-white/5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Register
                </a>
                <a href="{{ route('login') }}" class="flex items-center gap-3 px-5 py-3 text-sm text-white/80 hover:text-white hover:bg-white/5 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Login
                </a>
            </div>
        </div>
    </div>
</header>
