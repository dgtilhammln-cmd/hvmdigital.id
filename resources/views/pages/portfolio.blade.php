@extends('layouts.app')
@section('content')

{{-- HERO --}}
<section class="relative pt-40 pb-20 overflow-hidden"
         style="background:linear-gradient(135deg,#053d33 0%,#075749 60%,#0a6d58 100%);">
    <div class="absolute inset-0 opacity-[0.07] pointer-events-none"
         style="background-image:linear-gradient(rgba(154,203,3,0.4)1px,transparent 1px),linear-gradient(90deg,rgba(154,203,3,0.4)1px,transparent 1px);background-size:48px 48px;"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full opacity-20 blur-3xl pointer-events-none" style="background:radial-gradient(circle,#9acb03,transparent);"></div>
    <div class="relative z-10 container mx-auto px-4 lg:px-8 text-center max-w-3xl">
        <nav class="flex items-center justify-center gap-2 text-white/40 text-xs font-light mb-6" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-[#9acb03]">Portfolio</span>
        </nav>
        <span class="inline-block text-[#9acb03] text-xs font-semibold tracking-widest uppercase mb-4">Hasil Nyata</span>
        <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 leading-tight">
            Portfolio HVM Digital
        </h1>
        <p class="text-white/60 text-base font-light max-w-2xl mx-auto mb-8">
            Karya nyata yang telah kami bangun untuk klien di seluruh Indonesia — firma hukum, perusahaan engineering, properti, hingga F&B.
        </p>
        {{-- Quick stats --}}
        <div class="flex flex-wrap items-center justify-center gap-6">
            @foreach([['100+','Klien Aktif'],['300+','Project Selesai'],['35+','Kota Layanan']] as [$n,$l])
            <div class="text-center">
                <div class="text-2xl font-bold text-[#9acb03]">{{ $n }}</div>
                <div class="text-white/40 text-xs font-light">{{ $l }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- FILTER BAR --}}
<section class="sticky top-0 z-30 bg-white dark:bg-[#0a1510] border-b border-[#075749]/10 dark:border-[#9acb03]/10 shadow-sm">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-wrap items-center gap-3 py-4 overflow-x-auto">
            {{-- Region filter --}}
            <div class="flex items-center gap-1 shrink-0">
                <span class="text-xs text-gray-400 font-light mr-1 hidden sm:block">Wilayah:</span>
                @foreach([null=>'Semua','barat'=>'Indonesia Barat','tengah'=>'Indonesia Tengah','timur'=>'Indonesia Timur'] as $val=>$label)
                <a href="{{ route('portfolio', array_filter(['wilayah'=>$val ?: null,'kategori'=>$category])) }}"
                   class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all
                          {{ ($region ?? '') === (string)$val
                             ? 'bg-[#075749] text-white shadow-md'
                             : 'bg-[#f0fdf4] dark:bg-[#0d1f15] text-[#075749] dark:text-[#9acb03] hover:bg-[#075749]/10' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
            <div class="w-px h-5 bg-gray-200 dark:bg-gray-700 hidden sm:block"></div>
            {{-- Category filter --}}
            <div class="flex items-center gap-1 flex-wrap">
                <span class="text-xs text-gray-400 font-light mr-1 hidden sm:block">Kategori:</span>
                <a href="{{ route('portfolio', array_filter(['wilayah'=>$region,'kategori'=>null])) }}"
                   class="px-4 py-1.5 rounded-full text-xs font-semibold transition-all whitespace-nowrap
                          {{ !$category ? 'bg-[#9acb03] text-[#053d33] shadow-md' : 'bg-[#f0fdf4] dark:bg-[#0d1f15] text-[#075749] dark:text-[#9acb03] hover:bg-[#9acb03]/10' }}">
                    Semua Kategori
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('portfolio', array_filter(['wilayah'=>$region,'kategori'=>$cat])) }}"
                   class="px-4 py-1.5 rounded-full text-xs font-semibold transition-all whitespace-nowrap
                          {{ $category === $cat ? 'bg-[#9acb03] text-[#053d33] shadow-md' : 'bg-[#f0fdf4] dark:bg-[#0d1f15] text-[#075749] dark:text-[#9acb03] hover:bg-[#9acb03]/10' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>
            {{-- Result count --}}
            <div class="ml-auto shrink-0 hidden md:block">
                <span class="text-xs text-gray-400 font-light">{{ $portfolios->total() }} proyek ditemukan</span>
            </div>
        </div>
    </div>
</section>

{{-- PORTFOLIO GRID --}}
<section class="py-14 bg-[#f0fdf4] dark:bg-[#061009]"
         itemscope itemtype="https://schema.org/ItemList">
    <meta itemprop="name" content="Portfolio HVM Digital">
    <div class="container mx-auto px-4 lg:px-8">

        @if($portfolios->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5">
            @foreach($portfolios as $i => $p)
            <article class="group relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl
                            transition-all duration-500 hover:-translate-y-2 cursor-pointer"
                     style="aspect-ratio:9/16;"
                     itemprop="itemListElement" itemscope itemtype="https://schema.org/CreativeWork">
                <meta itemprop="position" content="{{ $i + 1 }}">
                <meta itemprop="name" content="{{ $p->title }}">
                {{-- Image --}}
                <img src="{{ asset($p->featured_image_thumb ?: $p->featured_image) }}"
                     alt="{{ $p->title }}{{ $p->city ? ' — '.$p->city : '' }} | Portfolio HVM Digital"
                     title="{{ $p->title }}"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                     loading="lazy" width="360" height="640"
                     onerror="this.src='{{ asset('images/portfolio/portoweb1.webp') }}'">
                {{-- Gradient always-on --}}
                <div class="absolute inset-0" style="background:linear-gradient(to top,rgba(0,0,0,0.95) 0%,rgba(0,0,0,0.6) 40%,rgba(0,0,0,0.1) 70%,transparent 100%);"></div>
                {{-- City badge only — top-left --}}
                @if($p->city)
                <div class="absolute top-3 left-3 z-10">
                    <span class="inline-flex items-center gap-1 text-[10px] font-semibold bg-[#9acb03] text-[#053d33] px-2.5 py-1 rounded-full leading-none">
                        <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                        {{ $p->city }}
                    </span>
                </div>
                @endif
                {{-- Bottom content --}}
                <div class="absolute bottom-0 left-0 right-0 p-4 z-10">
                    @if($p->client)
                    <p class="text-[#9acb03] text-[10px] font-bold uppercase tracking-wider mb-1.5">{{ $p->client }}</p>
                    @endif
                    <h2 class="font-bold text-white text-sm leading-snug mb-1.5 line-clamp-2"
                        itemprop="description">{{ $p->title }}</h2>
                    @if($p->url)
                    <div class="opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                        <a href="{{ wa_link('Halo HVM Digital, saya tertarik dengan portofolio: '.$p->title) }}"
                           target="_blank" rel="noopener"
                           class="wa-btn inline-flex items-center gap-1.5 text-[11px] font-semibold
                                  bg-[#9acb03] text-[#053d33] px-3 py-1.5 rounded-full hover:bg-[#b8e832] transition-colors">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            Tanya Proyek Ini
                        </a>
                    </div>
                    @endif
                </div>
            </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($portfolios->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $portfolios->links() }}
        </div>
        @endif

        @else
        {{-- Empty state --}}
        <div class="text-center py-20">
            <div class="w-16 h-16 rounded-2xl bg-[#9acb03]/10 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-[#9acb03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="text-gray-400 text-sm font-light">Tidak ada portofolio untuk filter ini.</p>
            <a href="{{ route('portfolio') }}" class="mt-4 inline-block text-[#9acb03] text-sm hover:underline">Lihat semua portfolio →</a>
        </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="py-16" style="background:linear-gradient(135deg,#075749,#9acb03);">
    <div class="container mx-auto px-4 lg:px-8 text-center max-w-xl">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">Siap Membangun Website Anda?</h2>
        <p class="text-white/75 font-light mb-7 text-sm">Konsultasi gratis — ceritakan kebutuhan Anda, kami siapkan solusinya.</p>
        <a href="{{ wa_link('Halo HVM Digital, saya melihat portfolio Anda dan ingin konsultasi') }}"
           target="_blank" rel="noopener"
           class="w-full sm:w-auto justify-center wa-btn inline-flex items-center gap-3 bg-white text-[#075749] font-bold px-10 py-4 rounded-full hover:scale-105 hover:shadow-2xl transition-all">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
            Mulai Konsultasi Gratis
        </a>
    </div>
</section>
@endsection
