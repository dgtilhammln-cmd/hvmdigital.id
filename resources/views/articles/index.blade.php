@extends('layouts.app')
@section('content')

<main>

{{-- ═══════════════════════════════════════════════════════════════
     HERO — matches services page style exactly
════════════════════════════════════════════════════════════════════ --}}
<section class="relative pt-40 pb-20 overflow-hidden" style="background:linear-gradient(135deg,#053d33 0%,#075749 60%,#0a6d58 100%);">
    <div class="absolute inset-0 opacity-[0.07]" style="background-image:linear-gradient(rgba(154,203,3,0.4) 1px,transparent 1px),linear-gradient(90deg,rgba(154,203,3,0.4) 1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-20 blur-3xl pointer-events-none" style="background:radial-gradient(circle,#9acb03,transparent);"></div>

    <div class="relative container mx-auto px-4 lg:px-8 text-center max-w-3xl">

        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-white/40 text-xs font-light mb-6 flex-wrap" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @if($activeCategory)
                <a href="{{ route('articles') }}" class="hover:text-white transition-colors">Artikel</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                @if($activeCategory->parent)
                    <a href="{{ route('articles', ['kategori' => $activeCategory->parent->slug]) }}" class="hover:text-white transition-colors">{{ $activeCategory->parent->name }}</a>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                @endif
                <span class="text-[#9acb03]">{{ $activeCategory->name }}</span>
            @else
                <span class="text-[#9acb03]">Artikel & Blog</span>
            @endif
        </nav>

        <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-4">Blog & Insight</span>

        <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight mb-5">
            @if($activeCategory)
                {{ $activeCategory->name }}<br>
                <span style="background:linear-gradient(135deg,#9acb03,#b8e832);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Artikel Terpilih</span>
            @else
                Tips & Insight<br>
                <span style="background:linear-gradient(135deg,#9acb03,#b8e832);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Digital Marketing</span>
            @endif
        </h1>

        <p class="text-white/60 text-base md:text-lg font-light leading-relaxed mb-8">
            {{ $activeCategory?->description ?: 'Strategi, panduan, dan insight dari tim HVM Digital untuk membantu bisnis Anda tumbuh di era digital.' }}
        </p>

        {{-- Search --}}
        <form action="{{ route('articles') }}" method="GET" class="relative max-w-lg mx-auto">
            @if($activeCategory)
            <input type="hidden" name="kategori" value="{{ $activeCategory->slug }}">
            @endif
            <input type="text" name="q" value="{{ $search ?? '' }}"
                   placeholder="Cari artikel, tips, tutorial..."
                   class="w-full bg-white/10 backdrop-blur-sm border border-white/20 text-white placeholder-white/40 font-light text-sm pl-5 pr-16 py-4 rounded-full focus:outline-none focus:border-[#9acb03]/60 transition-all">
            <button type="submit"
                    style="position:absolute;right:6px;top:50%;transform:translateY(-50%);background:linear-gradient(135deg,#9acb03,#b8e832);width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:none;cursor:pointer;flex-shrink:0;">
                <svg style="width:16px;height:16px;color:#053d33;" fill="none" stroke="#053d33" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </button>
        </form>

        {{-- Stats --}}
        <div class="flex items-center justify-center gap-6 mt-8 text-white/40 text-xs font-light">
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                {{ $articles->total() }} artikel
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                {{ $parentCategories->count() }} kategori
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Update rutin
            </span>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════
     MAIN — Sidebar Filter + Article Grid
════════════════════════════════════════════════════════════════════ --}}
<section class="py-16 bg-[#f0fdf4] dark:bg-[#061009]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- ───── SIDEBAR ───── --}}
            <aside class="lg:w-72 shrink-0" x-data="{ openFilter: false }">
                
                {{-- Mobile toggle button --}}
                <button @click="openFilter = !openFilter" class="lg:hidden w-full flex items-center justify-between px-5 py-4 bg-white dark:bg-[#0d1f15] border border-[#075749]/10 dark:border-[#9acb03]/10 rounded-2xl shadow-sm mb-4">
                    <span class="font-semibold text-[#0a1f12] dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        Filter & Kategori
                    </span>
                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="openFilter ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div class="sticky top-24 space-y-4" :class="openFilter ? 'block' : 'hidden lg:block'">

                    {{-- Sort --}}
                    <div class="bg-white dark:bg-[#0d1f15] rounded-2xl p-5 border border-[#075749]/10 dark:border-[#9acb03]/10 shadow-sm">
                        <p class="text-[#0a1f12] dark:text-white text-xs font-semibold tracking-widest uppercase mb-4 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"/></svg>
                            Urutkan
                        </p>
                        <div class="space-y-1">
                            @foreach(['newest'=>'Terbaru','popular'=>'Terpopuler','oldest'=>'Terlama'] as $val=>$label)
                            <a href="{{ request()->fullUrlWithQuery(['sort'=>$val]) }}"
                               class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-sm transition-all {{ $sort===$val ? 'font-medium text-[#053d33] dark:text-[#9acb03]' : 'font-light text-gray-500 dark:text-gray-400 hover:bg-[#075749]/5 dark:hover:bg-[#9acb03]/5' }}"
                               style="{{ $sort===$val ? 'background:rgba(154,203,3,0.12);' : '' }}">
                                <span class="w-1.5 h-1.5 rounded-full shrink-0 {{ $sort===$val ? 'bg-[#9acb03]' : 'bg-gray-300 dark:bg-gray-700' }}"></span>
                                {{ $label }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- All articles --}}
                    <a href="{{ route('articles', array_filter(['q'=>$search,'sort'=>$sort!='newest'?$sort:null])) }}"
                       class="flex items-center justify-between px-5 py-3.5 rounded-2xl border transition-all {{ !$activeCategory ? 'border-[#9acb03]/40' : 'bg-white dark:bg-[#0d1f15] border-[#075749]/10 dark:border-[#9acb03]/10 hover:border-[#9acb03]/30' }}"
                       style="{{ !$activeCategory ? 'background:rgba(154,203,3,0.12);' : '' }}">
                        <span class="flex items-center gap-2.5 text-sm {{ !$activeCategory ? 'font-semibold text-[#053d33] dark:text-[#9acb03]' : 'font-light text-gray-600 dark:text-gray-400' }}">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            Semua Artikel
                        </span>
                        <span class="text-xs {{ !$activeCategory ? 'text-[#9acb03] font-semibold' : 'text-gray-400' }}">{{ $articles->total() }}</span>
                    </a>

                    {{-- Category tree — brand colors only --}}
                    @foreach($parentCategories as $parent)
                    @php $isParentActive = $activeCategory && ($activeCategory->id === $parent->id || $activeCategory->parent_id === $parent->id); @endphp
                    <div class="bg-white dark:bg-[#0d1f15] rounded-2xl border {{ $isParentActive ? 'border-[#9acb03]/30' : 'border-[#075749]/10 dark:border-[#9acb03]/10' }} overflow-hidden shadow-sm transition-all">
                        <button onclick="toggleCat('cat-{{ $parent->id }}')"
                                class="w-full flex items-center justify-between px-5 py-3.5 text-left hover:bg-[#f0fdf4] dark:hover:bg-[#9acb03]/5 transition-all">
                            <div class="flex items-center gap-3 min-w-0">
                                {{-- Brand accent indicator instead of custom color --}}
                                <span class="w-1 h-5 rounded-full shrink-0 {{ $isParentActive ? 'bg-[#9acb03]' : 'bg-[#075749]/30 dark:bg-[#9acb03]/20' }}"></span>
                                <a href="{{ route('articles', array_filter(['kategori'=>$parent->slug,'q'=>$search,'sort'=>$sort!='newest'?$sort:null])) }}"
                                   class="text-sm truncate {{ $isParentActive ? 'font-semibold text-[#075749] dark:text-[#9acb03]' : 'font-medium text-[#0a1f12] dark:text-white hover:text-[#075749] dark:hover:text-[#9acb03]' }} transition-colors"
                                   onclick="event.stopPropagation()">
                                    {{ $parent->name }}
                                </a>
                            </div>
                            <div class="flex items-center gap-2 shrink-0 ml-2">
                                @if($parent->articles_count > 0)
                                <span class="text-[10px] font-light {{ $isParentActive ? 'text-[#9acb03]' : 'text-gray-400' }} tabular-nums">{{ $parent->articles_count }}</span>
                                @endif
                                <svg id="arrow-cat-{{ $parent->id }}"
                                     class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200 {{ $isParentActive ? 'rotate-90' : '' }}"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </button>

                        @if($parent->children->count())
                        <div id="cat-{{ $parent->id }}"
                             class="{{ $isParentActive ? '' : 'hidden' }} border-t border-[#075749]/5 dark:border-white/5">
                            @foreach($parent->children->sortBy('sort_order') as $child)
                            @php $isChildActive = $activeCategory && $activeCategory->id === $child->id; @endphp
                            <a href="{{ route('articles', array_filter(['kategori'=>$child->slug,'q'=>$search,'sort'=>$sort!='newest'?$sort:null])) }}"
                               class="flex items-center justify-between pl-10 pr-5 py-2.5 text-sm transition-all {{ $isChildActive ? 'text-[#075749] dark:text-[#9acb03] font-medium' : 'text-gray-500 dark:text-gray-400 font-light hover:text-[#075749] dark:hover:text-[#9acb03]' }}"
                               style="{{ $isChildActive ? 'background:rgba(154,203,3,0.07);' : '' }}">
                                <span class="flex items-center gap-2 truncate">
                                    <svg class="w-3 h-3 shrink-0 {{ $isChildActive ? 'text-[#9acb03]' : 'text-gray-300 dark:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    <span class="truncate">{{ $child->name }}</span>
                                </span>
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </aside>

            {{-- ───── ARTICLE GRID ───── --}}
            <div class="flex-1 min-w-0">

                {{-- Active filters bar --}}
                @if($activeCategory || $search)
                <div class="flex items-center gap-3 mb-6 flex-wrap">
                    @if($activeCategory)
                    <span class="inline-flex items-center gap-2 text-xs font-medium px-3.5 py-1.5 rounded-full border"
                          style="background:{{ $activeCategory->color }}18; border-color:{{ $activeCategory->color }}40; color:{{ $activeCategory->color }};">
                        <span class="w-1.5 h-1.5 rounded-full inline-block" style="background:{{ $activeCategory->color }};"></span>
                        {{ $activeCategory->name }}
                        <a href="{{ route('articles', array_filter(['q'=>$search,'sort'=>$sort!='newest'?$sort:null])) }}"
                           class="hover:opacity-70 ml-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </a>
                    </span>
                    @endif
                    @if($search)
                    <span class="inline-flex items-center gap-2 text-xs font-medium px-3.5 py-1.5 rounded-full bg-white dark:bg-[#0d1f15] border border-gray-200 dark:border-white/10 text-gray-600 dark:text-gray-400">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        "{{ $search }}"
                        <a href="{{ request()->fullUrlWithQuery(['q'=>null]) }}" class="hover:opacity-70">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </a>
                    </span>
                    @endif
                    <span class="text-gray-400 text-xs font-light ml-auto">{{ $articles->total() }} ditemukan</span>
                </div>
                @else
                <div class="flex items-center justify-end mb-6">
                    <span class="text-gray-400 text-xs font-light">{{ $articles->total() }} artikel tersedia</span>
                </div>
                @endif

                @if($articles->count())

                {{-- Featured first article (if page 1 and no filter) --}}
                @if($articles->currentPage() === 1 && !$activeCategory && !$search)
                @php $featured = $articles->first(); @endphp
                <a href="{{ route('articles.show', $featured->slug) }}"
                   class="group block bg-white dark:bg-[#0d1f15] rounded-3xl overflow-hidden border border-[#075749]/10 dark:border-[#9acb03]/10 hover:border-[#9acb03]/40 hover:shadow-2xl transition-all duration-300 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="aspect-video md:aspect-auto overflow-hidden relative">
                            @if($featured->featured_image)
                            <img src="{{ get_image_url($featured->featured_image) }}"
                                 alt="{{ $featured->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                 loading="eager">
                            @else
                            <div class="w-full h-full min-h-[200px] flex items-center justify-center"
                                 style="background:linear-gradient(135deg,{{ $featured->articleCategory?->color ?? '#075749' }}33,{{ $featured->articleCategory?->color ?? '#075749' }}66);">
                                <svg class="w-16 h-16 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                            @endif
                            @if($featured->articleCategory)
                            <div class="absolute top-4 right-4 z-10">
                                <span class="text-xs font-semibold px-3 py-1 rounded-full text-white backdrop-blur-sm"
                                      style="background:{{ $featured->articleCategory->color }}ee;">
                                    {{ $featured->articleCategory->name }}
                                </span>
                            </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent to-black/10 md:block hidden"></div>
                        </div>
                        <div class="p-8 flex flex-col justify-center">
                            <span class="text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-3">Artikel Pilihan</span>
                            <h2 class="font-bold text-[#0a1f12] dark:text-white text-xl md:text-2xl leading-snug mb-4 group-hover:text-[#075749] dark:group-hover:text-[#9acb03] transition-colors">
                                {{ $featured->title }}
                            </h2>
                            @if($featured->excerpt)
                            <p class="text-gray-500 dark:text-gray-400 text-sm font-light leading-relaxed mb-6 line-clamp-3">
                                {{ $featured->excerpt }}
                            </p>
                            @endif
                            <div class="flex items-center gap-4 text-xs text-gray-400 font-light mb-6">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $featured->published_at?->format('d M Y') }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    {{ number_format($featured->views) }} views
                                </span>
                            </div>
                            <span class="inline-flex items-center gap-2 text-sm font-semibold text-[#075749] dark:text-[#9acb03] group-hover:gap-3 transition-all">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </div>
                    </div>
                </a>

                {{-- Rest of articles --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($articles->slice(1) as $article)
                    @include('articles._card', ['article' => $article])
                    @endforeach
                </div>

                @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($articles as $article)
                    @include('articles._card', ['article' => $article])
                    @endforeach
                </div>
                @endif

                {{-- Pagination --}}
                @if($articles->hasPages())
                <div class="mt-12 flex justify-center">{{ $articles->withQueryString()->links() }}</div>
                @endif

                @else
                <div class="bg-white dark:bg-[#0d1f15] rounded-3xl p-20 text-center border border-[#075749]/10 dark:border-[#9acb03]/10">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5"
                         style="background:linear-gradient(135deg,rgba(7,87,73,0.1),rgba(154,203,3,0.1)); border:1px solid rgba(154,203,3,0.15);">
                        <svg class="w-7 h-7 text-[#075749] dark:text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <p class="text-[#0a1f12] dark:text-white font-semibold mb-2">Belum ada artikel tersedia</p>
                    <p class="text-gray-400 font-light text-sm mb-6">Konten untuk kategori ini akan segera hadir.</p>
                    <a href="{{ route('articles') }}"
                       class="inline-flex items-center gap-2 text-sm font-medium px-5 py-2.5 rounded-full border border-[#075749]/30 dark:border-[#9acb03]/30 text-[#075749] dark:text-[#9acb03] hover:bg-[#075749] hover:text-white dark:hover:bg-[#9acb03] dark:hover:text-[#053d33] transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Semua Artikel
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

</main>

@push('scripts')
<script>
function toggleCat(id) {
    const el   = document.getElementById(id);
    const arr  = document.getElementById('arrow-' + id);
    const open = !el.classList.contains('hidden');
    el.classList.toggle('hidden', open);
    if (arr) arr.classList.toggle('rotate-90', !open);
}
</script>
@endpush

@endsection
