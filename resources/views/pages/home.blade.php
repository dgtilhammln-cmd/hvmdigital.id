@extends('layouts.app')
@section('content')

@include('pages.partials.hero')
@include('pages.partials.stats')
@include('pages.partials.clients')
@include('pages.partials.about-services')
@include('pages.partials.map-cta')

{{-- === INSTAGRAM FEEDS (SEO FRIENDLY) === --}}
<section class="py-24 bg-white dark:bg-[#0a1510] relative overflow-hidden" itemscope itemtype="https://schema.org/ItemList">
    <meta itemprop="name" content="Instagram Feeds & Update HVM Digital">
    <meta itemprop="description" content="Desain feed Instagram terbaru dari HVM Digital yang menampilkan tips, promo, dan portofolio layanan digital marketing.">
    
    {{-- Decorative glows --}}
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#9acb03]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-[#075749]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-16 gap-6 border-b border-[#075749]/10 dark:border-[#9acb03]/10 pb-8">
            <div>
                <div class="inline-flex items-center gap-2 bg-[#9acb03]/10 text-[#075749] dark:text-[#9acb03] px-3.5 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase mb-4">
                    <svg class="w-4 h-4 text-[#9acb03]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <span>Instagram Feeds</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white mb-4 leading-tight">
                    Update &amp; Inspirasi Visual
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-light max-w-xl leading-relaxed">
                    Jelajahi ide, promo, dan portofolio desain visual terbaru kami di Instagram. Klik pada gambar untuk melihat detail postingan langsung di Instagram.
                </p>
            </div>
            <a href="{{ setting('instagram', 'https://www.instagram.com/hvmdigital.id') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 text-[#075749] dark:text-[#9acb03] font-medium border-b-2 border-[#9acb03] pb-1 hover:opacity-80 transition-opacity shrink-0">
                <span>Follow Instagram Kami</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        {{-- 4 Feeds Grid (Aspect Ratio 4:5 / 3375x4219) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            @for($i = 1; $i <= 4; $i++)
            @php
                $img  = setting("feed_{$i}_image");
                $alt  = setting("feed_{$i}_alt", "Desain Feed Instagram HVM Digital {$i}");
                $link = setting("feed_{$i}_link", setting('instagram', 'https://www.instagram.com/hvmdigital.id'));
                // Fallback image if not yet uploaded in admin
                $fallback = asset("images/portfolio/portoweb{$i}.webp");
            @endphp
            <article class="group relative rounded-2xl overflow-hidden bg-gray-100 dark:bg-[#0d1f15] shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-[#075749]/5 dark:border-[#9acb03]/10" itemprop="item" itemscope itemtype="https://schema.org/CreativeWork" style="aspect-ratio: 4/5;">
                <meta itemprop="position" content="{{ $i }}">
                <meta itemprop="name" content="{{ $alt }}">
                <meta itemprop="url" content="{{ $link }}">
                
                <a href="{{ $link }}" target="_blank" rel="noopener" class="absolute inset-0 z-20" title="{{ $alt }}">
                    <span class="sr-only">Lihat postingan Instagram: {{ $alt }}</span>
                </a>

                {{-- Skeleton Background --}}
                <div class="absolute inset-0 bg-gray-200 dark:bg-[#1a2e1e] animate-pulse z-0"></div>

                {{-- Image --}}
                <img src="{{ $img ? get_image_url($img) : $fallback }}" alt="{{ $alt }}" title="{{ $alt }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 relative z-10" loading="lazy" width="3375" height="4219" onerror="this.src='{{ $fallback }}'">

                {{-- Hover Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-[#053d33]/90 via-[#075749]/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 z-10 pointer-events-none">
                    <div class="translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <div class="inline-flex items-center gap-1.5 bg-[#9acb03] text-[#053d33] px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider mb-2 shadow">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s:2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            <span>Lihat di Instagram</span>
                        </div>
                        <h3 class="text-white font-bold text-base leading-snug line-clamp-2 mb-1">{{ $alt }}</h3>
                        <p class="text-white/70 text-xs font-light">Klik untuk membuka postingan asli</p>
                    </div>
                </div>
            </article>
            @endfor
        </div>
    </div>
</section>

{{-- === PORTFOLIO === --}}
@if($portfolios->count())
<section class="py-24 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-end justify-between mb-12">
            <div>
                <span class="inline-block text-xs font-semibold tracking-widest uppercase text-[#075749] dark:text-[#9acb03] mb-3">Karya Kami</span>
                <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white">Portfolio Terpilih</h2>
            </div>
            <a href="{{ route('portfolio') }}" class="hidden md:flex items-center gap-1 text-[#075749] dark:text-[#9acb03] font-medium border-b-2 border-[#9acb03] pb-1 hover:opacity-80 transition-opacity">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <style>
            .desktop-grid { display: none; }
            .mobile-slider { display: block; }
            @media (min-width: 768px) {
                .desktop-grid { display: block; }
                .mobile-slider { display: none; }
            }
        </style>
        {{-- Desktop View (Grid) --}}
        <div class="desktop-grid">
            <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1.25rem;">
                @foreach($portfolios as $p)
                <div class="group relative overflow-hidden rounded-2xl bg-gray-100 dark:bg-[#111d16] aspect-[9/16] hover:shadow-xl transition-all">
                    <a href="{{ route('portfolio') }}#{{ $p->slug ?? $p->id }}" class="absolute inset-0 z-20"><span class="sr-only">{{ $p->title }}</span></a>
                    {{-- Skeleton Background --}}
                    <div class="absolute inset-0 bg-gray-200 dark:bg-[#1a2e1e] animate-pulse z-0"></div>
                    @if($p->featured_image)
                        <img src="{{ get_image_url($p->featured_image_thumb ?? $p->featured_image) }}" alt="{{ $p->title }}" loading="lazy" class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-500 relative z-10">
                    @else
                        <div class="w-full h-full flex items-center justify-center relative z-10" style="background: linear-gradient(135deg, #075749, #0a6d58);">
                            <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5 z-10" style="background: linear-gradient(to top, rgba(7,87,73,0.9), transparent);">
                        <div>
                            <p class="text-white font-semibold text-sm">{{ $p->title }}</p>
                            <p class="text-[#9acb03] text-xs font-light">{{ $p->category }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Mobile View (Swipeable Slider) --}}
        <div class="mobile-slider">
            <div class="flex gap-4 overflow-x-auto snap-x snap-mandatory pb-6 scroll-smooth" style="scrollbar-width: none;">
                @foreach($portfolios as $p)
                <div class="group relative overflow-hidden rounded-2xl bg-gray-100 dark:bg-[#111d16] w-[65vw] shrink-0 snap-center aspect-[9/16]">
                    <a href="{{ route('portfolio') }}#{{ $p->slug ?? $p->id }}" class="absolute inset-0 z-20"><span class="sr-only">{{ $p->title }}</span></a>
                    {{-- Skeleton Background --}}
                    <div class="absolute inset-0 bg-gray-200 dark:bg-[#1a2e1e] animate-pulse z-0"></div>
                    @if($p->featured_image)
                        <img src="{{ get_image_url($p->featured_image_thumb ?? $p->featured_image) }}" alt="{{ $p->title }}" loading="lazy" class="w-full h-full object-cover object-top relative z-10">
                    @else
                        <div class="w-full h-full flex items-center justify-center relative z-10" style="background: linear-gradient(135deg, #075749, #0a6d58);">
                            <svg class="w-10 h-10 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 flex items-end p-5 z-10" style="background: linear-gradient(to top, rgba(7,87,73,0.9), transparent);">
                        <div>
                            <p class="text-white font-semibold text-sm">{{ $p->title }}</p>
                            <p class="text-[#9acb03] text-xs font-light">{{ $p->category }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

{{-- === TESTIMONI === --}}
@if($testimonials->count())
<section class="py-24 bg-white dark:bg-[#0a1510] relative">
    <div class="container mx-auto px-4 lg:px-8 relative">
        <div class="flex flex-col md:flex-row items-center justify-between mb-14 gap-6">
            <div class="text-center md:text-left">
                <span class="inline-block text-xs font-semibold tracking-widest uppercase text-[#075749] dark:text-[#9acb03] mb-4">Apa Kata Mereka</span>
                <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white">Testimoni Klien Kami</h2>
            </div>
        </div>
        
        {{-- Unified Swipeable Slider (1 Row for Desktop & Mobile) --}}
        <div class="relative w-full overflow-hidden">
            <div class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-6 scroll-smooth cursor-grab active:cursor-grabbing" style="scrollbar-width: none;">
                @foreach($testimonials as $t)
                <div class="shrink-0 w-[85vw] md:w-[calc(33.333%-1rem)] lg:w-[calc(33.333%-1rem)] snap-center bg-[#f0fdf4] dark:bg-[#0d1f15] rounded-2xl p-7 border border-[#075749]/10 dark:border-[#9acb03]/10 hover:border-[#9acb03]/40 hover:shadow-xl transition-all duration-300">
                    <div class="flex gap-1 mb-4">
                        @for($star = 1; $star <= 5; $star++)
                        <svg class="w-4 h-4 {{ $star <= $t->rating ? 'text-yellow-400' : 'text-gray-200 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 font-light text-sm leading-relaxed mb-6">"{{ $t->content }}"</p>
                    <div class="flex items-center gap-3 border-t border-[#075749]/10 dark:border-[#9acb03]/10 pt-5">
                        @if($t->photo)
                            <img src="{{ get_image_url($t->photo) }}" alt="{{ $t->name }}" class="w-10 h-10 rounded-full object-cover shrink-0 border-2 border-[#9acb03]/30">
                        @else
                            <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0" style="background: linear-gradient(135deg, #075749, #9acb03);">
                                {{ strtoupper(substr($t->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-semibold text-[#0a1f12] dark:text-white text-sm">{{ $t->name }}</div>
                            <div class="text-gray-500 dark:text-gray-400 text-xs font-light">{{ $t->company }} @if($t->city) &middot; {{ $t->city }} @endif</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

{{-- === ARTIKEL TERBARU === --}}
@if($articles->count())
<section class="py-24 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-end justify-between mb-12">
            <div>
                <span class="inline-block text-xs font-semibold tracking-widest uppercase text-[#075749] dark:text-[#9acb03] mb-3">Tips &amp; Insight</span>
                <h2 class="text-3xl md:text-4xl font-bold text-[#0a1f12] dark:text-white">Artikel Terbaru</h2>
            </div>
            <a href="{{ route('articles') }}" class="hidden md:flex items-center gap-1 text-[#075749] dark:text-[#9acb03] font-medium border-b-2 border-[#9acb03] pb-1 hover:opacity-80 transition-opacity">
                Semua Artikel
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <article class="bg-white dark:bg-[#0d1f15] rounded-3xl overflow-hidden border border-gray-100 dark:border-white/5 flex flex-col group hover:-translate-y-2 transition-all duration-500 shadow-lg hover:shadow-2xl">
                <div class="relative aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-[#111d16]">
                    {{-- Skeleton Background --}}
                    <div class="absolute inset-0 bg-gray-200 dark:bg-[#1a2e1e] animate-pulse z-0"></div>
                    @if($article->featured_image)
                        <img src="{{ get_image_url($article->featured_image_thumb ?? $article->featured_image) }}" alt="{{ $article->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 relative z-10">
                    @else
                        <div class="w-full h-full flex items-center justify-center relative z-10" style="background: linear-gradient(135deg, #075749, #9acb03);">
                            <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4 z-20 bg-white/90 dark:bg-[#0a1f12]/90 backdrop-blur-md px-3.5 py-1 rounded-full text-[11px] font-semibold text-[#075749] dark:text-[#9acb03] shadow-sm">
                        {{ $article->articleCategory?->name ?? $article->category ?? 'Digital Marketing' }}
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="text-[11px] text-gray-500 dark:text-white/50 mb-2 font-light">
                            {{ $article->published_at?->format('d M Y') ?? $article->created_at->format('d M Y') }} &middot; {{ $article->published_at?->diffForHumans() }}
                        </div>
                        <h3 class="font-bold text-[#0a1f12] dark:text-white text-lg mb-3 group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors line-clamp-2 leading-snug">
                            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>
                        <p class="text-xs text-gray-500 dark:text-white/60 line-clamp-3 font-light leading-relaxed mb-6">
                            {{ $article->excerpt }}
                        </p>
                    </div>
                    <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-[#075749] dark:text-[#9acb03] group-hover:translate-x-1 transition-transform">
                        Baca Selengkapnya <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
